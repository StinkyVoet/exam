import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

let editors = document.querySelectorAll('#editor');
editors.forEach((e, key) => {
    ClassicEditor
        .create(e)
        .catch(error => {
            console.error(error);
        });
});
