<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $birthday_start = strtotime("1960-1-01 00:00:00");
        $birthday_end =  strtotime("2016-12-31 23:59:59");
        $random_birthday = date("Y-m-d H:i:s", rand($birthday_start, $birthday_end));

        $created_start = strtotime("2022-1-01 00:00:00");
        $created_end =  strtotime("2022-10-31 23:59:59");
        $random_created = date("Y-m-d H:i:s", rand($created_start, $created_end));

        $municipalities = array('Gasan', 'Boac', 'Mogpog', 'Sta. Cruz', 'Torrijos', 'Buenavista');
        $baranggay_gasan = array('Antipolo', 'Bachao Ibaba', 'Bachao Ilaya', 'Bacong-bacong', 'Bahi', 'Bangbang', 'Banot',
                                    'Banuyo', 'Bognuyan', 'Cabugao', 'Dawis', 'Dili', 'Libtangin', 'Mahunig', 'Mangiliol',
                                    'Masiga', 'Mt. Gasan', 'Pangi', 'Pinggan', 'Tabionan', 'Tapuyan', 'Tiguion',
                                    'Baranggay I', 'Baranggay II', 'Baranggay III');
        $baranggay_boac = array('Agot', 'Agumaymayan', 'Amoingon', 'Apitong', 'Balagasan', 'Balaring', 'Balimbing', 'Balogo',
                                    'Bamban', 'Bangbangalon', 'Bantad', 'Bantay', 'Bayuti', 'Binunga', 'Boi', 'Boton', 
                                    'Buliasnin', 'Bunganay', 'Caganhao', 'Canat', 'Catubugan', 'Cawit', 'Daig', 'Daypay',
                                    'Duyay', 'Hinapulan', 'Ihatub', 'Isok 1', 'Isok 2', 'Laylay', 'Lupac', 'Mahinhin',
                                    'Mainit', 'Malbog', 'Maligaya', 'Malusak', 'Mansiwat', 'Mataas na Bayan', 'Maybo', 'Mercado', 
                                    'Murallon', 'Ogbac', 'Pawa', 'Pili', 'Poctoy', 'Poras', 'Puting Buhangin', 'Puyog', 'Sabong', 
                                    'San Miguel', 'Santol', 'Sawi', 'Tabi', 'Tabigue', 'Tagwak', 'Tambunan', 'Tampus', 'Tanza',
                                    'Tugos', 'Tumagabok', 'Tumapon');
        $baranggay_buenavista = array('Bagacay', 'Bagtingon', 'Bicas-bicas', 'Caigangan', 'Daykitin', 'Libas', 'Malbog', 'Sihi',
                                    'Timbo', 'Lipata', 'Yook', 'Baranggay I', 'Baranggay II', 'Baranggay III', 'Baranggay IV');
        $baranggay_mogpog = array('Sibucao', 'Argao', 'Balanacan', 'Banto', 'Bintakay', 'Bocboc', 'Butansapa', 'Candahon',
                                    'Capayang', 'Danao', 'Dulong Bayan', 'Gitnang Bayan', 'Guisian', 'Hinadharan', 'Hinanggayon',
                                    'Ino', 'Janagdong', 'Lamesa', 'Laon', 'Magapua', 'Malayak', 'Malusak', 'Mampaitan',
                                    'Mangyan-Mababad', 'Market Site', 'Mataas na Bayan', 'Mendez', 'Nangka I', 'Nangka II', 'Paye',
                                    'Pili', 'Puting Buhangin', 'Sayao', 'Silangan', 'Sumangga', 'Tarug', 'Villa Mendez');
        $baranggay_stacruz = array('Alobo', 'Angas', 'Aturan', 'Bagong Silangan', 'Baguidbirin', 'Baliis', 'Balogo', 'Banahaw',
                                    'Bangcuangan', 'Biga', 'Botilao', 'Buyabod', 'Dating Bayan', 'Devilla', 'Dolores', 'Haguimit',
                                    'Hupi', 'Ipil', 'Jolo', 'Kaganhao', 'Kalangkang', 'Kamandugan', 'Kasily', 'Kilo-kilo',
                                    'Kinyaman', 'Labo', 'Lamesa', 'Landy', 'Lapu-lapu', 'Libjo', 'Lipa', 'Lusok', 'Maharlika',
                                    'Makulapnit', 'Maniwaya', 'Manlibunan', 'Masaguisi', 'Masalukot', 'Matalaba', 'Mongpong',
                                    'Morales', 'Napo', 'Pag-asa', 'Pantayin', 'Polo', 'Pulong-parang', 'Punong', 'San Antonio',
                                    'San Isidro', 'Tagum', 'Tamayo', 'Tambangan', 'Tawiran', 'Taytay');
        $baranggay_torrijos = array('Bangwayin', 'Bayakbakin', 'Bolo', 'Bonliw', 'Buangan', 'Cabuyo', 'Cagpo', 'Dampulan', 'Kay Duke',
                                    'Mabuhay', 'Makawayan', 'Malibago', 'Malinao', 'Maranlig', 'Marlangga', 'Matuyatuya', 'Nangka',
                                    'Pakaskasan', 'Payanas', 'Poblacion', 'Poctoy', 'Sibuyao', 'Suha', 'Talawan', 'Tigwi');
        $municipality = $this->faker->randomElement($municipalities);
        if($municipality == 'Gasan'){
            $baranggay = $this->faker->randomElement($baranggay_gasan);
        }
        else if($municipality == 'Boac'){
            $baranggay = $this->faker->randomElement($baranggay_boac);
        }
        else if($municipality == 'Mogpog'){
            $baranggay = $this->faker->randomElement($baranggay_mogpog);
        }
        else if($municipality == 'Sta. Cruz'){
            $baranggay = $this->faker->randomElement($baranggay_stacruz);
        }
        else if($municipality == 'Torrijos'){
            $baranggay = $this->faker->randomElement($baranggay_torrijos);
        }
        else if($municipality == 'Buenavista'){
            $baranggay = $this->faker->randomElement($baranggay_buenavista);
        }
        $address = $baranggay.', '.$municipality;
        if(rand(0,100) < 90){
            $type = 'normal';
        }
        else{
            $type = 'doctor';
        }
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'birthday' => $random_birthday,
            'gender' => $this->faker->randomElement(['female','male']),
            'address' => $address,
            'bio' => fake()->paragraph(2),
            // 'phone_number' => $number,
            'email_verified_at' => now(),
            'password' => bcrypt('lollipop'), // password
            'remember_token' => Str::random(10),
            'type' => $type,
            'created_at' => $random_created
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
