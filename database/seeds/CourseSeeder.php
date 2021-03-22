<?php

use App\Helpers\Image;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                "title" => "Curso de Laravel 7",
                "description" => "Aprende Laravel 7 desde 0 con las mejores prácticas.",
                "price" => 9.99,
                "featured" => 1,
                "bg" => "F35144",
                "categories" => [1],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Laravel y Voyager",
                "description" => "Desarrollo de sistemas de administración brutales con Laravel Voyager.",
                "price" => 11.99,
                "bg" => "F35144",
                "categories" => [1],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Laravel y Vuejs",
                "description" => "Laravel y Vuejs, dos poderosas herramientas para el desarrollo de sitios web.",
                "price" => 19.99,
                "bg" => "F35144",
                "categories" => [1, 3]
            ],
            [
                "title" => "Node.js y Express",
                "description" => "Node.js en el servidor con su Framework por excelencia, Express, fácil y rápido de aprender",
                "price" => 29.99,
                "featured" => 1,
                "bg" => "8DBC58",
                "categories" => [2],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "MVC con Node.js y TypeScrpt",
                "description" => "Vamos a crear un sistema MVC con Node.js y TypeScript desde 0 para aprender a crear nuestros propios proyectos desde 0",
                "price" => 29.99,
                "bg" => "8DBC58",
                "categories" => [2]
            ],
            [
                "title" => "Vuejs y Vuex",
                "price" => 24.99,
                "description" => "Vuex es el almacén de datos por excelencia para Vuejs, un objeto global que nos facilita la vida a los programadores",
                "featured" => 1,
                "bg" => "41B881",
                "categories" => [3],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Vue 3",
                "description" => "La nueva versión de Vuejs, Vue 3 nos ofrece una nueva API y una nueva forma de escribir nuestros proyectos sin perder lo que ya conocíamos",
                "price" => 14.99,
                "bg" => "41B881",
                "categories" => [3],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Vue y TypeScript",
                "description" => "De forma alternativa Vuejs nos ofrece la posibilidad de tipar nuestro código utilizando TypeScript, aquí aprenderás cómo hacerlo",
                "price" => 19.99,
                "featured" => 1,
                "bg" => "41B881",
                "categories" => [3],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Reactjs CRUD",
                "description" => "Para aprender cualquier lenguaje de programación/framework una de las mejores vías para entender muchas cosas",
                "price" => 9.99,
                "bg" => "0CC1E9",
                "categories" => [4]
            ],
            [
                "title" => "React Native y Expo",
                "price" => 39.99,
                "description" => "Aprende a desarrrollar aplicaciones móviles con React Native y Expo paso a paso con este súper curso",
                "featured" => 1,
                "bg" => "0CC1E9",
                "categories" => [4],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Deno from Scratch",
                "description" => "Deno -> Node es la nueva herramienta que nos ofrece Ryan Dahl, el creador de Node.js, para desarrollar software en el servidor con JavaScript",
                "price" => 9.99,
                "featured" => 1,
                "bg" => "0098B6",
                "categories" => [5],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "MVC con Deno",
                "description" => "Vamos a crear un pequeño sistema MVC con Deno y Alosaur, dos poderosas herramientas que gracias a los decoradores nos permiten hacer cosas increíbles",
                "price" => 9.99,
                "bg" => "0098B6",
                "categories" => [5]
            ],
            [
                "title" => "API REST con Deno",
                "description" => "Algo muy típico cuando estamos empezando es desarrollar una pequeña API REST, por llamarle de alguna forma, que nos permite interactuar con Deno en este caso",
                "price" => 9.99,
                "bg" => "0098B6",
                "categories" => [5]
            ],
            [
                "title" => "Primer proyecto Amplify",
                "description" => "Aprende a desarrollar tu primer proyecto básico con Amplify Framework, una poderosa herramienta de Amazon Web Services",
                "price" => 9.99,
                "featured" => 1,
                "bg" => "FF9733",
                "categories" => [6],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Cognito y Amplify",
                "description" => "Cognite en Amplify Framework nos permite desarrollar un completo sistema de autenticación fácil y seguro para nuestros usuarios",
                "price" => 14.99,
                "bg" => "FF9733",
                "categories" => [6]
            ],
            [
                "title" => "DynamoDB y Amplify",
                "description" => "Con DynamoDB podemos crear bases de datos utilizando NoSQL que gracias a Amplify Framework podemos combinar con GraphQL, ¡no te pierdas este curso!",
                "price" => 19.99,
                "featured" => 1,
                "bg" => "FF9733",
                "categories" => [6],
                "status" => Course::PUBLISHED
            ],
            [
                "title" => "Lambda y Amplify",
                "description" => "Las funciones Lambda son una gran herramienta para llevar a cabo muchas tareas comunes, eventos de Cognito, Triggers para gestionar eventos y mucho más",
                "price" => 19.99,
                "bg" => "FF9733",
                "categories" => [6]
            ],
        ];

        foreach ($courses as $course) {
            $categories = $course['categories'];
            $course['picture'] = Image::image(
                storage_path('app/public/courses'),
                $course['title'],
                $course['bg'],
                850,
                350,
                false
            );
            $course['user_id'] = User::whereRole(User::TEACHER)->get()->random()->id;
            unset($course['categories']);
            unset($course['bg']);
            $model = Course::create($course);
            $model->categories()->sync($categories);
        }
    }
}
