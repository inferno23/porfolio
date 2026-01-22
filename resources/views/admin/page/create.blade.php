@extends('layouts.backend.app',[
	'title' => 'Create page',
	'pageTitle' => 'Create page',
])
@section('content')
@include('layouts.components.datatables')
@include('layouts.components.alert-dismissible')

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

<div id="toolbar-container">
  <span class="ql-formats">
   
     <select class="ql-font">
        <option selected>Sans Serif</option>
         <option value="arial">Arial</option>
         <option value="calibri">Calibri</option>
         <option value="courier">Courier</option>
                  <option value="georgia">Georgia</option>
                  <option value="lucida">Lucida </option>
                  <option value="open">Open </option>
                  <option value="times">Times </option>

         <option value="sofia">Sofia</option>
          <option value="slabo">Slabo</option>
        <option value="inconsolata">Inconsolata</option>
        <option value="roboto">Roboto</option>
        <option value="mirza">Mirza</option>
       
         <option value="ubuntu">Ubuntu</option>
      </select>

    <select class="ql-size"></select>
  </span>
  <span class="ql-formats">
    <button class="ql-bold"></button>
    <button class="ql-italic"></button>
    <button class="ql-underline"></button>
    <button class="ql-strike"></button>
  </span>
  <span class="ql-formats">
    <select class="ql-color"></select>
    <select class="ql-background"></select>
  </span>
  <span class="ql-formats">
    <button class="ql-script" value="sub"></button>
    <button class="ql-script" value="super"></button>
  </span>
  <span class="ql-formats">
    <button class="ql-header" value="1"></button>
    <button class="ql-header" value="2"></button>
    <button class="ql-blockquote"></button>
    <button class="ql-code-block"></button>
  </span>
  <span class="ql-formats">
    <button class="ql-list" value="ordered"></button>
    <button class="ql-list" value="bullet"></button>
    <button class="ql-indent" value="-1"></button>
    <button class="ql-indent" value="+1"></button>
  </span>
  <span class="ql-formats">
    <button class="ql-direction" value="rtl"></button>
    <select class="ql-align"></select>
  </span>
  <span class="ql-formats">
    <button class="ql-link"></button>
    <button class="ql-image"></button>
    <button class="ql-video"></button>
    <button class="ql-formula"></button>
  </span>
  <span class="ql-formats">
    <button class="ql-clean"></button>
  </span>
</div>
<div id="editor">
</div>

<!-- Initialize Quill editor -->
<script>

    // Add fonts to whitelist
let Font = Quill.import('formats/font')

// We do not add Sans Serif since it is the default
Font.whitelist = ['arial','calibri','courier','georgia','lucida','open','times','sofia',  'slabo','inconsolata', 'roboto', 'mirza', 'ubuntu', 'tahoma', 'verdana',]
Quill.register(Font, true)
  const quill = new Quill('#editor', {
    modules: {
      syntax: true,
      toolbar: '#toolbar-container',
    },
    placeholder: 'Escribir aqui',
    theme: 'snow',
  });
</script>
<!-- Style -->
<link href="https://fonts.cdnfonts.com/css/inconsolata-2" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Fira+Code" rel="stylesheet">
<style>
  /* Set dropdown font-families */
   #toolbar-container .ql-font span[data-label="Arial"]::before {
    font-family: "Arial";
  }
   #toolbar-container .ql-font span[data-label="Calibri"]::before {
    font-family: "Calibri";
  }

   #toolbar-container .ql-font span[data-label="Courier"]::before {
    font-family:'Courier New';
  }

   #toolbar-container .ql-font span[data-label="Georgia"]::before {
    font-family:'Georgia';
  }


   #toolbar-container .ql-font span[data-label="Lucida"]::before {
    font-family:'Lucida Console, Monaco, monospace';
  }

   #toolbar-container .ql-font span[data-label="Open"]::before {
    font-family:'Open Sans', sans-serif;
  }

   #toolbar-container .ql-font span[data-label="Times"]::before {
    font-family:'Times New Roman, Times, serif';
  }
  #toolbar-container .ql-font span[data-label="Ubuntu"]::before {
    font-family:'Times New Roman, Times, serif';
  }
#toolbar-container .ql-font span[data-label="Sofia"]::before {
    font-family:"Cambria, Cochin, Georgia, Times, Times New Roman, serif ";
  }
  #toolbar-container .ql-font span[data-label="Slabo"]::before {
    font-family: "fantasy";
  }

  #toolbar-container .ql-font span[data-label="Sans Serif"]::before {
    font-family: "Sans Serif";
  }
  
  #toolbar-container .ql-font span[data-label="Inconsolata"]::before {
    font-family: "Inconsolata";
  }
  
  #toolbar-container .ql-font span[data-label="Roboto"]::before {
    font-family: "Roboto";
  }
  
  #toolbar-container .ql-font span[data-label="Mirza"]::before {
    font-family: "Mirza";
  }
  #toolbar-container .ql-font span[data-label="Tahoma"]::before {
    font-family: "Tahoma";
  }
  #toolbar-container .ql-font span[data-label="Verdana"]::before {
    font-family: "Verdana";
  }
 
  /* Set content font-families */
  
  .ql-font-inconsolata {
    font-family: "Inconsolata";
  }
  
  .ql-font-roboto {
    font-family: "Roboto";
  }
  
  .ql-font-mirza {
    font-family: "Mirza";
  }
  
  .ql-font-arial {
    font-family: "Arial";
  }

  .ql-font-calibri {
    font-family: "Calibri";
  }
  .ql-font-courier {
    font-family: "Courier New", Courier, monospace;
  }
  .ql-font-georgia {
    font-family: "Georgia";
  }
  .ql-font-lucida {
    font-family: "Lucida Console, Monaco, monospace";
  }

  .ql-font-tahoma {
    font-family: "Tahoma";
  }
  .ql-font-verdana {
    font-family: "Verdana";
  }

  .ql-font-times {
    font-family: "Times New Roman, Times, serif";
  }
  .ql-font-open {
    font-family: "Open Sans", sans-serif;
  }
  /* We do not set Sans Serif since it is the default font */
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<a href="{{ route('page.index') }}" class="btn btn-danger btn-sm"><- volver al Listado</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('page.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input class="form-control @error('title') is-invalid @enderror" name="title" id="title" type="">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripcion</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"></textarea>
    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
            </div>
            <div class="form-group">
                <label for="description">Imagen</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Seleccione una imagen</label>
                </div>
                @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Crear Registro</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('js-script')
<script type="text/javascript">
    $(".custom-file-input").on("change",function(){
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename)
    })
</script>
@stop