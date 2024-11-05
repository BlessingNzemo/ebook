<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'book_id' => null,
            'review' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fake()->dateTimeBetween('created_at', 'now'),
        ];
    }

    public function good()
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(4, 5),
            ];
        });
    }

    public function average()
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(2, 5),
            ];
        });
    }

    public function bad()
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(1,     3),
            ];
        });
    }
}
//$reviews =$book->reviews; signifie que reviews est une collection de reviews liées au livre

//\App\Models\Book::with('reviews')->find(1); permet de récupérer le livre dont l'id est 1 avec ses reviews

//\App\Models\Book::where('title', 'LIKE', '%qui%')->get(); permet de récupérer tous les livres dont le titre contient 'qui'

//$book->load('reviews'); permet de charger les reviews associées au livre
//review = new Review(); crée une nouvelle instance de Review
//$review = new \App\Models\Review(); permet de créer une nouvelle instance de Review
//$review->review = 'Le nouveau révu crée!'; permet de définir la valeur de la propriété review de l'instance $review
//$review->save(); permet d'enregistrer l'instance $review dans la base de données
//$review->delete(); permet de supprimer l'instance $review de la base de données
//$review->book_id = $book->id; permet de définir la valeur de la propriété book_id de l'instance $review
//$review->save(); permet d'enregistrer l'instance $review dans la base de données

//\App\Models\Book::where('title', 'LIKE', '%laudantium%')->toSQL();      = "select * from `books` where `title` LIKE ?"
//\App\Models\Book::title('qui')->where('created_at', '>', '2023-01-01')-get(); signifie que l'on récupère tous les livres dont le titre contient 'qui' et dont la date de création est postérieure au 1er janvier 2023

//\App\Models\Book::withCount('reviews')->get(); permet de récupérer tous les livres avec le nombre de reviews associées à chacun
//La commande \App\Models\Book::title('qui')->where('created_at', '>','2023-01-01')->get(); permet de récupérer les titres qui ont un qui dans le titre et dont la date de création est postérieure au 1er janvier 2023
