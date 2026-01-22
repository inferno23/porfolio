@extends('layouts.backend.app',[
	'title' => 'Create page',
	'pageTitle' => 'Create page',
])
@section('content')


    <!-- Incluye los estilos y scripts de Quill -->
    <link href="https://fonts.googleapis.com/css2?family=Arial:wght@400&family=Roboto:wght@400&family=Times+New+Roman:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        #editor-container {
            height: 200px; /* Ajusta la altura del editor */
        }
         /* Estilo para las fuentes personalizadas */
         .ql-font-arial {
            font-family: 'Arial', sans-serif;
        }
        .ql-font-times-new-roman {
            font-family: 'Times New Roman', serif;
        }
        .ql-font-verdana {
            font-family: 'Verdana', sans-serif;
        }
        .ql-font-roboto {
            font-family: 'Roboto', sans-serif;
        }
        .ql-font-courier-new {
            font-family: 'Courier New', monospace;
        }


        /* Estilo para los tamaños de fuente */
        .ql-size-small {
            font-size: 0.75em;
        }
        .ql-size-medium {
            font-size: 1em;
        }
        .ql-size-large {
            font-size: 1.5em;
        }
        .ql-size-huge {
            font-size: 2.5em;
        }
    </style>
    

    <div class="container">
        <h1>Crear Nuevo Post</h1>
        <form action="{{ route('page.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
              <label for="title">Titulo</label>
              <input required class="form-control @error('title') is-invalid @enderror" name="title" id="title" type="">
              @error('title')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
          </div>
            <div class="form-group">
                <label for="content">Contenido:</label> 
                <!-- Contenedor de Quill -->
                <div id="editor-container"></div>
                <!-- Input oculto para enviar el contenido -->
                <input type="hidden" id="description" name="description">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success btn-sm">Crear Registro</button>
          </div>
        </form>
    </div>
    <!-- Incluye el script de Quill -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
       // Registrar fuentes personalizadas
       let Font = Quill.import('formats/font');
        Font.whitelist = ['arial', 'times-new-roman', 'verdana', 'roboto', 'courier-new']; // Lista de fuentes permitidas
        Quill.register(Font, true);
        // Registrar tamaños de fuente
        let Size = Quill.import('attributors/style/size');
                Size.whitelist = ['small', 'medium', 'large', 'huge']; // Lista de tamaños permitidos
                Quill.register(Size, true);
        // Configura el editor Quill
        let quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Escribe aquí el contenido...',
            modules: {
                toolbar: [
                    [{ 'font': Font.whitelist }],          // Selector de fuentes personalizadas
                    [{ 'size': Size.whitelist }],          // Selector de tamaños de fuente
                    ['bold', 'italic', 'underline'],        // opciones de texto
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }], // listas
                    ['link', 'image'],                    // enlaces e imágenes
                    [{ 'align': [] }],                    // alineación
                    ['clean']                             // limpiar formato
                ]
            }
        });

        // Al enviar el formulario, añade el contenido al input oculto
        const form = document.querySelector('form');
        form.onsubmit = function() {
            const contentInput = document.querySelector('#description');
            contentInput.value = quill.root.innerHTML; // Pasa el contenido HTML al input oculto
        };
    </script>
    @stop
