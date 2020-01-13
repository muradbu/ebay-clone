var count = 0;


$(function () {
    var photosVal = [];

    var imagesPreview = function (input, placeToInsertImagePreview) {


        console.log(photosVal);

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                count++;
                if (count > 5) {
                    return;
                }

                let random = Math.floor(Math.random() * 10000);

                reader.onload = function (event) {
                    $($.parseHTML('<img class="py-2 px-2" width="300px" height="auto" onclick="photoPop(' + random + ');" id="' + random + '" />')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
                photosVal.push(input.files[i]);
            }
        }

    };

    $('#photo').on('change', function () {
        imagesPreview(this, 'div.gallery');
    });
});

function photoPop(index) {
    console.log(index);
    $('#'+index).remove();
}