<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AddressController extends Controller
{
    public function edit(): Response
    {
        $user = auth()->user();

        return Inertia::render('settings/Addresses', [
            'personalAddress' => $user->addresses()->where('type', 'personal')->first(),
            'companyAddress' => $user->addresses()->where('type', 'company')->first()
        ]);
    }

    public function updatePersonal(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20'
        ]);

        $user = auth()->user();

        $company = $user->addresses()->where('type', 'company')->first();
        if ($company) {
            $company->update(array_merge($validated, ['is_default' => false]));
        }

        $user->addresses()->updateOrCreate(
            ['type' => 'personal'],
            array_merge($validated, [
                'is_default' => true,
                'company_name' => null,
                'tax_id' => null,
            ]),
        );

        return redirect()->back()->with('success', 'Personal address updated');
    }

    public function updateCompany(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20'
        ]);

        $user = auth()->user();

        $personal = $user->addresses()->where('type', 'personal')->first();
        if ($personal) {
            $personal->update(array_merge($validated, ['is_default' => false]));
        }

        $user->addresses()->updateOrCreate(
            ['type' => 'company'],
            array_merge($validated, ['is_default' => true])
        );

        return redirect()->back()->with('success', 'Company address updated');
    }
}
