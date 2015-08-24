<div class="form-group @if($errors->has('title')) has-error @endif">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>

<div class="form-group @if($errors->has('body')) has-error @endif">
    {{ Form::label('body', 'Body') }}
    {{ Form::textarea('body', null, ['class' => 'form-control']) }}
</div>

<button class="btn btn-primary">Save</button>