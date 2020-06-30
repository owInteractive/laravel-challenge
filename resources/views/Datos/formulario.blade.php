
@auth
<div class="container">
@csrf
<div class="form-group">
<label for="title"> Nombre del evento</label>
<input class="form-control bg-light shadow-sm" 
id="title"
type="text" 
name="title"  
value="{{ old('title', $editar->title) }}">
</div>

<div class="form-group">
<label for="description"> Descripcion del evento </label>
<textarea class="form-control bg-light shadow-sm" 
id="description"
name="description">{{ old('description', $editar->description) }}</textarea>
</div>

<div class="form-group">
<label for="dataI"> Fecha de inicio</label>
<input class="form-control bg-light shadow-sm" 
id="dataI"
type="date" 
name="dataI" 
value="{{ old('dataI', $editar->dataI) }}">
</div>

<div class="form-group">
<label for="dataF"> Fecha de fin </label>
<input class="form-control bg-light shadow-sm" 
id=dataF
type="date" 
name="dataF"  
value="{{ old('dataF', $editar->dataF) }}">
</div>


<button class="bnt btn-primary btn-lg btn-block">{{ $btnText }} </button>
</div>

<br>
@endauth

