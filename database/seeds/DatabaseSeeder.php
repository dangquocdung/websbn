<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(MenuTopTableSeeder::class);
        // $this->call(MenuVBTableSeeder::class);
        // $this->call(LoaiTinTableSeeder::class);
        // $this->call(LoaiVBTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('users')->delete();
      DB::table('users')->insert([
        ['name' => 'Quản trị viên', 'email' => 'quantrivien', 'password'=>bcrypt('123456@'), 'level'=>'15'],
        ['name' => 'Tổng biên tập', 'email' => 'tongbientap', 'password'=>bcrypt('123456@'), 'level'=>'3'],
        ['name' => 'Biên tập viên', 'email' => 'bientapvien', 'password'=>bcrypt('123456@'), 'level'=>'2']

      ]);
    }
}

class MenuTopTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('menutop')->delete();
      DB::table('menutop')->insert([
          ['ten' => 'Giới thiệu','slug' => str_slug('Giới thiệu'),'thutu' => '1'],
          ['ten' => 'Tin tức, Sự kiện','slug' => str_slug('Tin tức, Sự kiện'),'thutu' => '2'],
          ['ten' => 'Chuyên mục','slug' => str_slug('Chuyên mục'),'thutu' => '3']
      ]);
    }
}

class MenuVBTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('menuvb')->delete();
      DB::table('menuvb')->insert([
          ['ten' => 'Văn bản chỉ đạo, điều hành','slug' => str_slug('Văn bản chỉ đạo, điều hành'),'thutu' => '1'],
          ['ten' => 'Văn bản xử lý kiến nghị, yêu cầu','slug' => str_slug('Văn bản xử lý kiến nghị, yêu cầu'),'thutu' => '2'],
          ['ten' => 'Văn bản xử lý khiếu nại, tố cáo','slug' => str_slug('Văn bản xử lý khiếu nại, tố cáo'),'thutu' => '3'],
          ['ten' => 'QĐ Khen thưởng, kỉ luật', 'slug' => str_slug('QĐ Khen thưởng, kỉ luật'),'thutu' => '4']
      ]);
    }
}

class LoaiTinTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('loaitin')->delete();
      DB::table('loaitin')->insert([
          ['ten' => 'Tổ chức bộ máy','slug' => str_slug('Tổ chức bộ máy'),'menutop_id' => '1'],
          ['ten' => 'Chức năng, nhiệm vụ','slug' => str_slug('Chức năng, nhiệm vụ'),'menutop_id' => '1'],
          ['ten' => 'Lãnh đạo cơ quan','slug' => str_slug('Lãnh đạo cơ quan'),'menutop_id' => '1'],

          ['ten' => 'Chính trị','slug' => str_slug('Chính trị'),'menutop_id' => '2'],
          ['ten' => 'Kinh tế','slug' => str_slug('Kinh tế'),'menutop_id' => '2'],
          ['ten' => 'Văn hoá - Xã hội','slug' => str_slug('Văn hoá - Xã hội'),'menutop_id' => '2'],
          ['ten' => 'An ninh - Quốc phòng','slug' => str_slug('An ninh - Quốc phòng'),'menutop_id' => '2'],
          ['ten' => 'Giáo dục - Y tế','slug' => str_slug('Giáo dục - Y tế'),'menutop_id' => '2'],
          ['ten' => 'Cải cách hành chính','slug' => str_slug('Cải cách hành chính'),'menutop_id' => '2'],
          ['ten' => 'Xây dựng nông thôn mới','slug' => str_slug('Xây dựng nông thôn mới'),'menutop_id' => '2'],

          ['ten' => 'Tuyên truyền, phổ biến pháp luật','slug' => str_slug('Tuyên truyền, phổ biến pháp luật'),'menutop_id' => '3'],
          ['ten' => 'Chiến lược phát triển KT-XH','slug' => str_slug('Chiến lược phát triển KT-XH'),'menutop_id' => '3'],
          ['ten' => 'Phân bổ Ngân sách','slug' => str_slug('Phân bổ Ngân sách'),'menutop_id' => '3']
      ]);
    }
}

class LoaiVBTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('loaivb')->delete();
      DB::table('loaivb')->insert([
          ['tenloaivb' => 'Thông báo','slug' => str_slug('Thông báo')],
          ['tenloaivb' => 'Báo cáo','slug' => str_slug('Báo cáo')],
          ['tenloaivb' => 'Kế hoạch','slug' => str_slug('Kế hoạch')],
          ['tenloaivb' => 'Chương trình','slug' => str_slug('Chương trình')],
          ['tenloaivb' => 'Giấy mời','slug' => str_slug('Giấy mời')],
          ['tenloaivb' => 'Quyết định','slug' => str_slug('Quyết định')],
          ['tenloaivb' => 'Chỉ thị','slug' => str_slug('Chỉ thị')],
          ['tenloaivb' => 'Giấy phép','slug' => str_slug('Giấy phép')],
          ['tenloaivb' => 'Công văn','slug' => str_slug('Công văn')]
      ]);
    }
}
