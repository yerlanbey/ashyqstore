@extends('auth.layouts.master')

@section('content-section')
    <div class="container">
        <div class="col-md-12">

    <div class="col-md-8 mt-3">
      <div class="card">
        <div class="card-header">Проверьте свой адрес электронной почты</div>
        <div class="card-body" style="margin: 10px 15px;">
          @if ( session('resent') )
            <div class="alert alert-success" role="alert">
              На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.
            </div>
          @endif
          Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.
          Если вы не получили письмо,
          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            нажмите здесь, чтобы отправить повторно.</button>.
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
