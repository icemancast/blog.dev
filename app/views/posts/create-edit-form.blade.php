<div class="form-group @if($errors->has('title')) has-error @endif">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['class' => 'form-control']) }}

    {{ $errors->first('title', '<p class="help-block">:message</p>')}}
</div>

<div class="form-group @if($errors->has('body')) has-error @endif">
    {{ Form::label('body', 'Body') }}
    {{ Form::textarea('body', null, ['class' => 'form-control']) }}

    {{ $errors->first('body', '<p class="help-block">:message</p>')}}
</div>

<button class="btn btn-primary" type="submit">Save</button>
