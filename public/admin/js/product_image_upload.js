$(document).ready(function(){

    Dropzone.options.myAwesomeDropzone = {

        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,

        // Dropzone settings
        init: function() {
            var myDropzone = this;

            this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });
            this.on("sendingmultiple", function() {
            });
            this.on("successmultiple", function(files, response) {
            });
            this.on("errormultiple", function(files, response) {

            //     $.each(response, function(key, files){
            //
            //         $.each(files, function(index, value){
            //
            //             if(index == 0){
            //
            //                 if(value == 'validation.dimensions'){
            //                     console.log(value)
            //                     $(document).find('.errors').append(
            //                         '<div class="alert alert-danger">'+
            //                         '<ul>' +
            //                         '<li>Image min-height = 1024px, min-width=480px</li>'+
            //                         '</ul>'+
            //                         '</div>')
            //
            //                 }
            //                 else{
            //                     console.log(value)
            //                     $(document).find('.errors').append(
            //                         '<div class="alert alert-danger">'+
            //                         '<ul>' +
            //                         '<li>'+value+'</li>'+
            //                         '</ul>'+
            //                         '</div>')
            //
            //                 }
            //             }
            //             else{
            //                 console.log(value)
            //                 if(value == 'validation.dimensions') {
            //                     $(document).find('.errors ul').append(
            //                         '<li>Image min-height = 1024px, min-width=480px</li>')
            //
            //                 }
            //                 else{
            //                     console.log(value)
            //                     $(document).find('.errors ul').append(
            //                         '<li>'+value+'</li>')
            //
            //                 }
            //             }
            //         })
            //     })
            });
        }

    }

});