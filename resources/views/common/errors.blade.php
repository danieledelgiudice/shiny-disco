@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>Oops! Qualcosa è andato storto!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        
        <ul id="elenco-errori" class="hidden">
            @foreach ($errors->keys() as $field)
                <li>{{ $field }}</li>
            @endforeach
        </ul>
    </div>
@endif