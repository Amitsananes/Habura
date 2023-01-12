
        jQuery(document).ready(function($) {


            var HandleClick = false;


            function initialize() {
                document.body.onfocus = checkIt;




            }



            function checkIt() {


                setTimeout(() => {

                    let fileELement = $($('div[data-name="media_content"] input[type="hidden"]')[$('div[data-name="media_content"] input[type="hidden"]').length-2]);


                  if(fileELement.val()===""){

                    fileELement.parents("tr").remove();

                  }

                  HandleClick = false;


                }, 1000);


                document.body.onfocus = null;

            }








            $('div[data-name="media_content"] a[data-event="add-row"]').text("הוספת תמונה").click(function(e){

                console.log(HandleClick);


                if(!HandleClick){

                    HandleClick = true;

                    initialize();

                    setTimeout(() => {
                        $('div[data-name="media_content"] table').show();
                        $('div[data-name="media_content"] .hide-if-value').hide();

                        $('div[data-name="media_content"] .file-custom >.button')[$('div[data-name="media_content"] .file-custom').length-2].click();


                        let removeButton = $('div[data-name="media_content"] a[data-name="remove"]').clone()[0];
                        $('div[data-name="media_content"] a[data-name="remove"]').remove();


                        $(".acf-row-handle.remove").html(removeButton);


                        $('div[data-name="media_content"] .file-icon').addClass("upload_thumb").removeClass("file-icon");


                    }, 1000);

                }else{
                    e.preventDefault();
                    return;
                }


            })


            $(document).on("click" , 'div[data-name="media_content"] a[data-name="remove"]' , function(){


                    if($('[data-name="media_content"] table tr').length>1){
                        $(this).parents("tr").remove();
                    }else{
                        $('[data-name="media_content"] table').hide();
                    }

            })




        })