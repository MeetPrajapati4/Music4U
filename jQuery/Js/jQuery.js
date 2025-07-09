$(document).ready(function () {
    //     console.log($);
    //     $('p').click();
    // $('p').click(function () {
    //     console.log('We Clicked', this);
    // $(this).hide();//element
    //         $('#id').hide();// id
    //         $('.class').hide();//class

    //          Other selecters
    //         $('*').click(); // Universal Selector
    //         $('p:first').click(); // Universal Selector
    // })
    $('#btn').click(function () {
        // $('#text').fadeToggle(1000);
        // $('#text').slideToggle(2000);
        $('#text').animate({ opacity: 0.2 }, 2000);
        $('#text').animate({ opacity: 1 }, 500);
        // $('#text').stop(); // Stop Animation
        // $('#text').text('<h2>This is  Text function</h2>'); // get or Se value of text
        // $('#text').val(); // Get Value
        // $('#text').empty(); // Delete Value of element
        // $('#text').remove(); // Delete element
        // $('#text').addClass(); // Add Class 
        // $('#text').removeClass(); // Remove Class
        // $('#text').toggleClass(); // Toogle Class
        // $('#text').css('background-color', 'red');

        // Ajax Using jQuery
        // $.get('Url', function (data, status) {
        //     alert(data);
        // });
        // $.get('Url', function (data, status) {
        //     alert(status);
        // });
        // $.post('Url', { name: 'Meet', channel: 'Yoyogujrati' }, function (data, status) {
        //     alert(data);
        // });
    });

});