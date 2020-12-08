

$(document).ready(function () {

    // ClassicEditor
    //     .create(document.querySelector('#editor'), {
    //
    //         toolbar: {
    //             items: [
    //                 'heading',
    //                 '|',
    //                 'bold',
    //                 'italic',
    //                 'link',
    //                 '|',
    //                 'fontSize',
    //                 'fontColor',
    //                 'fontBackgroundColor',
    //                 'blockQuote',
    //                 'removeFormat',
    //                 '|',
    //                 'alignment',
    //                 'bulletedList',
    //                 'numberedList',
    //                 '|',
    //                 'indent',
    //                 'outdent',
    //                 '|',
    //                 'imageUpload',
    //                 'insertTable',
    //                 'mediaEmbed',
    //                 // 'fileUpload',
    //                 '|',
    //                 'undo',
    //                 'redo'
    //             ]
    //         },
    //         language: 'ru',
    //         image: {
    //             toolbar: [
    //                 'imageTextAlternative',
    //                 'imageStyle:full',
    //                 'imageStyle:side',
    //                 // 'linkImage'
    //             ]
    //         },
    //         table: {
    //             contentToolbar: [
    //                 'tableColumn',
    //                 'tableRow',
    //                 'mergeTableCells',
    //                 'tableCellProperties',
    //                 'tableProperties'
    //             ]
    //         },
    //         licenseKey: '',
    //     })
    //     .then(editor => {
    //         window.editor = editor;
    //     })
    //     .catch(error => {
    //         console.error('Oops, something went wrong!');
    //         console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
    //         console.warn('Build id: pjsjybtr0h5e-mvi9re9hddan');
    //         console.error(error);
    //     });
    ClassicEditor
        .create( document.querySelector( '#editor' ), {

            toolbar: {
                items: [
                    'undo',
                    'redo',
                    '|',
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'underline',
                    'horizontalLine',
                    'removeFormat',
                    'specialCharacters',
                    'strikethrough',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    'alignment',
                    '|',
                    'imageUpload',
                    'blockQuote',
                    'insertTable',
                    'mediaEmbed',
                    '|',
                    'fontBackgroundColor',
                    'fontColor',
                    'fontSize',
                    'fontFamily',
                    'highlight',
                    '|',
                    'exportPdf',
                    'exportWord',



                ]
            },
            language: 'ru',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side',
                    'linkImage'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells',
                    'tableCellProperties',
                    'tableProperties'
                ]
            },
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;








        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: imxr3hs8yb9j-tmrfqtddd9tl' );
            console.error( error );
        } );
});