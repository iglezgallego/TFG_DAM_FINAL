$(document).ready(async function() {
    // Capturar el cambio de idioma en el dropdown del home
    $('#floatingLanguage').on('change', function() {
        // Obtener el valor seleccionado
        var selectedValue = $(this).val();
        // Almacenar el valor seleccionado en localStorage
        localStorage.setItem('selectedLanguage', selectedValue);
        
        // Llamo a la función translate pasandole el idioma seleccionado
        translate(selectedValue);
    });
});

// TRADUCCIONES //

$(document).ready(async function() {
    // Obtener el idioma seleccionado del localStorage
    var selectedLanguage = localStorage.getItem('selectedLanguage');
    // Definir el idioma predeterminado
    const defaultLanguage = "es_ES";
    // Si hay un idioma seleccionado en el localStorage, úsalo; de lo contrario, utiliza el idioma predeterminado
    var languageToUse = selectedLanguage ? selectedLanguage : defaultLanguage;
    // Llamada a la función translate() con el idioma seleccionado
    var traducciones = await translate(languageToUse);
    console.log(traducciones);
});

// Definición de la función translate(), la cual realiza una solicitud AJAX para obtener traducciones
function translate(language) {
    var componentNameArray = ["titlePagSignin" ,"floatingInputSignin", "floatingPasswordSignin", "headlineSignin", "buttonaccessSignin", "signupbutton", "titlePagSignup", "floatingInput", "floatingPassword", "floatingEmail", "headline", "signupbutton", "floatingLanguage"]; // Array de nombres de componentes

    // Se devuelve una promesa para manejar el resultado de la solicitud AJAX
    return new Promise(function(resolve, reject) {
        // Se realiza la solicitud AJAX utilizando jQuery.ajax()
        $.ajax({
            url: '../ajaxTranslate.php', // URL del archivo PHP que maneja la traducción
            type: 'GET', // Método de solicitud HTTP
            data: {
                language: language, // Parámetro: idioma
                componentNameArray: JSON.stringify(componentNameArray) // Parámetro: array de nombres de componentes convertido a cadena JSON
            },
            // Función que se ejecuta cuando la solicitud AJAX se completa con éxito
            success: function(response) {
                // Parsear la respuesta JSON
                var translations = JSON.parse(response);

                // Actualizar los elementos HTML con las traducciones
                $('#titlePagSignin').text(translations.titlePagSignin);
                $('#floatingInputSignin').next('label').text(translations.floatingInputSignin);
                $('#floatingPasswordSignin').next('label').text(translations.floatingPasswordSignin);
                $('#headlineSignin').text(translations.headlineSignin);
                $('#buttonaccessSignin').text(translations.buttonaccessSignin);
                $('#signupbutton').text(translations.signupbutton);
                $('#titlePagSignup').text(translations.titlePagSignup);
                $('#floatingInput').next('label').text(translations.floatingInput);
                $('#floatingEmail').next('label').text(translations.floatingEmail);
                $('#floatingPassword').next('label').text(translations.floatingPassword);
                $('#headline').text(translations.headline);
                $('#floatingLanguage option[value=""]').text(translations.floatingLanguage);
                $('#signupbutton').text(translations.signupbutton);

                // Resolve la promesa con las traducciones
                resolve(translations);
            },
            // Función que se ejecuta si la solicitud AJAX falla
            error: function(xhr, status, error) {
                // Se imprime el error en la consola del navegador
                console.error(xhr);
                // Se rechaza la promesa con el mensaje de error
                reject(error);
            }
        });
    });
}

// Script para el dropdown del idioma con select2
$(document).ready(function() {
    // Inicializar Select2 en el elemento select
    $('#floatingLanguage').select2({
        templateResult: formatLang,
        templateSelection: formatLang
    });

    // Función para dar formato a cada opción de lenguaje
    function formatLang(lang) {
        if (!lang.id) { return lang.text; }
        var $lang = $(
            '<span><img src="img/' + lang.element.value.toLowerCase() + '.png" class="img-flag" /> ' + lang.text + '</span>'
        );
        return $lang;
    }
    // Obtener el idioma seleccionado del localStorage
    var selectedLanguage = localStorage.getItem('selectedLanguage');
    // Verificar si el idioma seleccionado está en el dropdown
    if (selectedLanguage) {
        // Seleccionar automáticamente la opción del idioma en el dropdown
        $('#floatingLanguage').val(selectedLanguage).trigger('change');
    }
});

// Actualizar el campo oculto con el langkey seleccionado usando jQuery
$(document).ready(function() {
    $('#floatingLanguage').change(function() {
        var selectedLangKey = $(this).find('option:selected').attr('langkey');
        $('#floatingLangkey').val(selectedLangKey);
    });
});

// Mostrar mensaje de error de usuario existente
function showErrorUserExists() {
    if (localStorage.getItem("selectedLanguage") === "en_EN") {
        alert("The user or email already exists");
    } else {
        alert("El usuario o email ya existe");
    }
}
