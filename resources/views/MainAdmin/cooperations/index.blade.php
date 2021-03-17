@extends('auth.layouts.master')

@section('title')
    Главная страница
@endsection

@section('content-section')
    <div class="container">
        <div class="col-md-12">
            <h1>Письма сотрудничество</h1>
            <table class="table">
                <tbody>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Имя
                    </th>
                    <th>
                        Номер телефона
                    </th>
                </tr>
                @foreach($cooperations as $cooperation)
                    <tr>
                        <td>{{ $cooperation->id }}</td>
                        <td>{{ $cooperation->first_name }}</td>
                        <td>{{ $cooperation->phone_number }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{ $cooperations->links() }}
        </div>
    </div>

@endsection
