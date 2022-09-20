<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class postFactory extends Factory
{
    /**
     * The name of the factory"s corresponding model.
     *
     * @var string
     */
    protected $model=Post::class;

    public function definition()
    {
        $price=["1,000,000", "2,000,000", "500,0000", "1,000", "2,000"];

        $url=[
            "https://dkstatics-public.digikala.com/digikala-products/a09e3c9a8e9e1f057e6433bc24a55cdfdfb5e738_1594667885.jpg?x-oss-process=image/resize,m_lfit,h_800,w_800/quality,q_90",
            "https://dkstatics-public.digikala.com/digikala-products/d94ea20add40c440513b00e5119b378c6bb5b4a8_1645623361.jpg?x-oss-process=image/resize,m_lfit,h_800,w_800/quality,q_90",
            "https://dkstatics-public.digikala.com/digikala-products/0166bb263dbfd72c8cf34651ae5560dd8b536315_1648454454.jpg?x-oss-process=image/resize,m_lfit,h_800,w_800/quality,q_90",
            "https://dkstatics-public.digikala.com/digikala-products/cbccdef999541cb3b11d447eb49bb81ebffa88f1_1657033933.jpg?x-oss-process=image/resize,m_lfit,h_800,w_800/quality,q_90"
        ];
        return [
            "title"=>$this->faker->title,
            "options"=>$this->faker->text,
            "price"=>$price[rand(1, 5)],
            "image_url"=>$url[rand(1, 4)],
            "body"=>"برای ورزش های هوازی و کوهنوردی شلوار خوب و متناسب حرف اول را می زند. شلوار متناسب و خوب می تواند در ورزشی که انجام می دهید یک همراه خوب باشد. شلوار کوهنوردی زنانه مدل COL-1603B بسیار سبک و راحت است. جنس پارچه قابل تنفس می باشد و در انجام فعالیت های روزمره باعث احساس گرما و حساسیت نمی شود. این مدل شلوار به علت داشتن جنس سبک در صورت خیس شدن به سرعت خشک می شود. با رسیدن بهار و فصول گرم سال به تدریج نیاز به پوشاک سبک و خنک احساس می شود , یکی از اساسی ترین پوشاک مورد استفاده در کو ...",
            "category_id"=>rand(1, 5)
        ];
    }
}
