<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Recipe;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RecipesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
        $dateExcel = $row['date_de_publication'];
        if (is_numeric($dateExcel)) {
            $formattedDate = Carbon::createFromTimestamp($dateExcel);
        } else {
            $formattedDate = Carbon::createFromFormat('d/m/Y H:i:s', $dateExcel);
        }

        if (!$formattedDate) {
            throw new \Exception('Format de date invalide : ' . $dateExcel);
        }

        $recipe = new Recipe([
            'titre' => $row['titre'],
            'description' => $row['description'],
            'date_de_publication' => $formattedDate,
            'image' => $row['image'],
            'temps_de_preparation' => $row['temps_de_preparation'],
            'temps_de_cuisson' => $row['temps_de_cuisson'],
            'niveau_de_difficulte' => $row['niveau_de_difficulte'],
        ]);

        $recipe->save();

        if (isset($row['categories'])) {
            $categories = explode(',', $row['categories']);
            foreach ($categories as $categoryName) {
                $category = Category::firstOrCreate(['nom' => $categoryName]);
                $recipe->categories()->attach($category->id);
            }
        }

        return $recipe;
    }
}
