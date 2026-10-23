<?php

use App\Models\Country;
use App\Models\City;

use Livewire\Component;

new class extends Component {
    public $countries;
    public $country;
    public $cities = [];

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function updated($property)
    {
        if ($property == 'country') {
            $this->cities = City::where('country_id', $this->country)->get();
        }
    }
};
?>

<div>
    <form>
        <label for="name">Company name</label>
        <br />
        <input name="name" required />

        <br /><br />
        <label for="country_id">Country</label>
        <br />
        <select wire:model.live="country" name="country_id" required>
            <option value="">-- choose country --</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>

        <br /><br />
        <label for="city_id">City</label>
        <br />
        <select name="city_id">
            @forelse ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @empty
                <option value="">-- choose country first --</option>
            @endforelse

        </select>

        <br /><br />
        <button type="submit">Save data</button>
    </form>
</div>
