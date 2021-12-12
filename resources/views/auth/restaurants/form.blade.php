<div class="box">
    <div class="box-header">
        <h2>Создать Заведение</h2>
    </div>
    <div class="box-body">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @elseif(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        <div class="form-group row">
            <label for="name" class="col-sm-2 form-control-label">Название магазина</label>
            <div class="col-sm-9">
                @include('auth.layouts.error', ['key' => 'name'])
                <input type="text" name="name" id="name" class="form-control rounded">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="slug">Код магазина</label>
            <div class="col-sm-9">
                @include('auth.layouts.error', ['key' => 'slug'])
                <input type="text" name="slug" id="slug" class="form-control rounded">
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="work_time">Время работы:</label>
            <div class="col-sm-9">
                @include('auth.layouts.error', ['key' => 'work_time'])
                <select name="work_time" id="work_time" class="form-control">
                    <option disabled="disabled" selected="selected" value>Выберите время</option>
                    <option>24 часа</option>
                    <option> 09:00 - 23:00</option>
                    <option> 09:00 - 00:00</option>
                    <option> 09:00 - 01:00</option>
                    <option> 09:00 - 02:00</option>
                    <option> 10:00 - 23:00</option>
                    <option> 10:00 - 00:00</option>
                    <option> 10:00 - 01:00</option>
                </select>
            </div>
        </div>


        <div class="form-group row">
            <label for="address" class="col-sm-2 form-control-label">Адрес</label>
            <div class="col-sm-9">
                @include('auth.layouts.error', ['key' => 'address'])
                <input type="text" name="address" id="address" class="form-control rounded">
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-sm-2 form-control-label">Контактные данные</label>
            <div class="col-sm-9">
                @include('auth.layouts.error', ['key' => 'phone'])
                <input type="text" name="phone" id="phone" class="form-control rounded">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-9">
                <input type="hidden" class="form-control rounded" name="user_id" id="user_id"
                       value="{{$userId->id}}">

            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label">Тип магазина</label>

            <div class="col-sm-9">
                @include('auth.layouts.error', ['key' => 'theme_code'])
                <select name="theme_code" id="theme_code" class="form-control input-c rounded" >
                    @foreach($themes as $theme)
                        <option value="{{ $theme->code }}">
                            {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="input-group row">
            <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
            <div class="col-sm-10">
                <label class="btn btn-default btn-file">
                    Загрузить <input type="file" style="display: none;" name="image" id="image">
                </label>
            </div>
        </div>

        <div class=" p-a text-right">
            <button type="submit" class="btn success">Создать</button>
        </div>

    </div>
</div>
