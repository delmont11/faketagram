import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const dropzone = new Dropzone(".dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if(document.querySelector('[name="img"]').value.trim()) {
            const file = {};
            file.size = 1234;
            file.name = document.querySelector('[name="img"]').value;
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, `/uploads/${file.name}`);
            file.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('success', function (file, response) {
    document.querySelector('[name="img"]').value = response.img;
});

dropzone.on('removedfile', function () {
    console.log('Árchivo eliminado');
    document.querySelector('[name="img"]').value = '';
});
