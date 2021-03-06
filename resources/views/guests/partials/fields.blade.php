@include('partials.input-fullwidth-inline-text', ['title' => 'First Name', 'name' => 'mo_first_name', 'required' => true, 'value' => (isset($guest) ? $guest->first_name : null)])
@include('partials.input-fullwidth-inline-text', ['title' => 'Last Name', 'name' => 'mo_last_name', 'required' => true, 'value' => (isset($guest) ? $guest->last_name : null)])
@include('partials.input-fullwidth-inline-text', ['title' => 'Nick Name', 'name' => 'mo_nick_name', 'required' => true, 'value' => (isset($guest) ? $guest->nick_name : null)])
@include('partials.input-fullwidth-inline-text', ['title' => 'Official Name', 'name' => 'mo_official_name', 'required' => true, 'value' => (isset($guest) ? $guest->official_name : null)])
@include('partials.input-fullwidth-inline-date', ['title' => 'Birth Date', 'name' => 'mo_birth_date', 'value' => ((isset($guest) and !! $guest->birth_date) ? $guest->birth_date->format('Y-m-d') : null)])
@include('partials.input-fullwidth-inline-text', ['title' => 'SSN', 'name' => 'mo_ssn', 'value' => (isset($guest) ? $guest->ssn : null)])
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Guest Photo</label>
    <label class="custom-file">
        <input type="file" id="file" name="guest_photo" class="custom-file-input">
        <span class="custom-file-control"></span>
    </label>
</div>

