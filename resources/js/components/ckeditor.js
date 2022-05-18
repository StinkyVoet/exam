import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

let editors = document.querySelectorAll('#editor');
// Maak van elk element op de pagina die het id 'editor' heeft een CKEditor veld
editors.forEach((e, key) => {
    ClassicEditor
        .create(e)
        .catch(error => {
            console.error(error);
        });
});
