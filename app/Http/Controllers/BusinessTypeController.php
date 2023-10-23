<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    //
    public function getBusinessTypes()
    {
        $businessTypes = [
            [
                'value' => 'Individual',
                'description' => 'Individual Business',
            ],
            [
                'value' => 'Business_Name',
                'description' => 'Business Name',
            ],
            [
                'value' => 'Sole_Proprietorship',
                'description' => 'Sole Proprietorship',
            ],
            [
                'value' => 'Private_Limited_Company',
                'description' => 'Private Limited Company',
            ],
            [
                'value' => 'Public_Limited_Company',
                'description' => 'Public Limited Company',
            ],
            [
                'value' => 'Public_Company_Limited_by_Guarantee',
                'description' => 'Public Company Limited by Guarantee',
            ],
            [
                'value' => 'Private_Unlimited_Company',
                'description' => 'Private Unlimited Company',
            ],
            [
                'value' => 'Public_Unlimited_Company',
                'description' => 'Public Unlimited Company',
            ],
            // Add other business types here
        ];

        return response()->json($businessTypes);
    }

}
