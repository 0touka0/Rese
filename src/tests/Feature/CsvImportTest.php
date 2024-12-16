<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Address;
use App\Models\Category;
use App\Models\User;

class CsvImportTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    protected $adminUser;

    public function setUp(): void
    {
        parent::setUp();

        Address::firstOrCreate(['address' => '東京都']);
        Category::firstOrCreate(['category' => '寿司']);

        $this->adminUser = User::where('role', 3)->first();
    }

    public function testCsvImportSuccessfullyImportsShops()
    {
        // 正常系テスト
        $csvContent = <<<CSV
        店舗名,地域,ジャンル,店舗概要,画像URL
        寿司太郎,東京都,寿司,新鮮なネタの寿司屋,http://example.com/sushi.jpeg
        CSV;

        Storage::fake('local');
        $filePath = 'test.csv';
        Storage::disk('local')->put($filePath, $csvContent);

        $uploadedFile = new UploadedFile(
            Storage::disk('local')->path($filePath),
            'test.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->actingAs($this->adminUser)->post(route('csv.import'), [
            'csv' => $uploadedFile,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', '店舗情報をインポートしました！');

        $this->assertDatabaseHas('shops', [
            'name' => '寿司太郎',
            'overview' => '新鮮なネタの寿司屋',
            'image' => 'http://example.com/sushi.jpeg',
        ]);
    }
}

