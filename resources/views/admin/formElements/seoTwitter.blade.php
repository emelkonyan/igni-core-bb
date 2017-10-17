<div class="form-group {{ $errors->has('twitter_title') ? 'has-error' : '' }}">
	<label for="seo_facebook_title">Twitter Title</label>
	<input type="text" id="twitter_title" name="twitter_title" placeholder="Twitter Title" class="form-control" value="{{ old('twitter_title') ?? $field->getModel()->seo->twitter_title ?? null }}">
	<div class="help-text">If you don't want to use the current title for sharing on Facebook but instead want another title there, write it here.</div>
	<div class="text-red">
        {{ join($errors->get('twitter_title'), '<br />') }}
    </div>
</div>
<div class="form-group {{ $errors->has('twitter_description') ? 'has-error' : '' }}">
    <label for="twitter_description">Twitter Description</label>
    <textarea id="twitter_description" name="twitter_description" placeholder="Twitter Description" class="form-control">{{ old('twitter_description') ?? $field->getModel()->seo->twitter_description ?? null }}</textarea>
    <div class="help-text">If you don't want to use the current meta description for sharing on Facebook but instead want another meta description there, write it here.</div>
    <div class="text-red">
        {{ join($errors->get('twitter_description'), '<br />') }}
    </div>
</div>
<div class="form-group {{ $errors->has('twitter_image') ? 'has-error' : '' }}">
    <label for="facebook_image">Twitter Image</label>
    @if($field->getModel()->hasImages('twitter_image'))
        <div class="form-group">
            @foreach($field->getModel()->getImages('twitter_image') as $image)
                <div class="image-row">
                    {!! Html::image($image->getOriginalImagePath('admin'), $image->alt, ['title' => $image->title]) !!}
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="'twitter_image_delete'">
                {!! Form::checkbox('twitter_image_delete',1,null,['id' => 'twitter_image_delete']) !!}
                Delete
            </label>
        </div>
    @endif

    {!! Form::file('twitter_image',  [
        'id' => 'twitter_image',
        'class' => "form-control",
        'placeholder' => 'Twitter Image',
    ] ) !!}

    <div class="help-text">If you want to override the image used on Twitter, upload an image here. The image size should be at least 1024x512 and with the same aspect ratio.</div>
    <div class="text-red">
        {{ join($errors->get('twitter_image'), '<br />') }}
    </div>
</div>