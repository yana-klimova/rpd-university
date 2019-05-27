$(document).ready(function () {
	showForm();
	showInputTimeOnReady();

	var oldInputTimeLab; 
	var oldInputTimePractice; 

	// $('.classroom-delete').on('click', function() {
	// 	$.pjax.reload("#pj-classroom", {timeout : false}) ;
	// });

	// $('.courses').on('click', function(){
	// 	alert('nkjhbjk');
	// 	// $('.courses').removeClass('selectedCourse');
	// 	// $(this).addClass('selectedCourse');
	// });

	$('input.time-lab-input').on('focus', function () {
	  oldInputTimeLab = this.value;

	});

	$('input.time-practice-input').on('focus', function () {
	  oldInputTimePractice = this.value;

	});

	$('input.time-lab-input').on('change', function () {
		var $labRemain = $('#lab-remain').html();
		if(!isNaN(this.value)&& this.value>0) {		
			
			$labRemain = +$labRemain + +oldInputTimeLab;
			$labRemain = $labRemain - this.value;
			if($labRemain>=0){
				$('#lab-remain').html($labRemain);

			} else {
				this.value = oldInputTimeLab;
				alert('Уменьшите выделенное время');
			}
		} else {
			this.value = oldInputTimeLab;
		}
	});

	$('input.time-practice-input').on('change', function () {
		var $practiceRemain = $('#practice-remain').html();
		if(!isNaN(this.value) && this.value>0) {		
			
			$practiceRemain = +$practiceRemain + +oldInputTimePractice;
			$practiceRemain = $practiceRemain - this.value;
			if($practiceRemain>=0){
				$('#practice-remain').html($practiceRemain);

			} else {
				this.value = oldInputTimePractice;
				alert('Уменьшите выделенное время');
			}
		} else {
			this.value = oldInputTimePractice;
		}  

	});

	$('input[name="sectionLabs[]"]').on('change', function () {

		var labs = document.getElementsByName("sectionLabs[]");
		var practices = document.getElementsByName("sectionPractices[]");
		var $labRemain = $('#lab-remain').html();
		if(this.checked) {
			$labRemain -=1;
			if($labRemain<0) {
				this.checked = '';
				alert(' Для добавления лабораторной, уменьшите выделенное время на другие лабораторные');
			} else {
				$(`#time-lab-${this.value}`).addClass('show');
				$('#lab-remain').html($labRemain);
			}
		} else {
			$(`#time-lab-${this.value}`).removeClass('show');
			$labRemain = + $(`#time-l-${this.value}`).val() + +$labRemain;
			$('#lab-remain').html($labRemain)
			$(`#time-l-${this.value}`).val(1);
		}
	});

	$('input[name="sectionPractices[]"]').on('change', function () {

		var practices = document.getElementsByName("sectionPractices[]");
		var $practiceRemain = $('#practice-remain').html();
		if(this.checked) {
			$practiceRemain -=1;
			if($practiceRemain<0) {
				this.checked = '';
				alert(' Для добавления практической, уменьшите выделенное время на другие лабораторные');
			} else {
				$(`#time-practice-${this.value}`).addClass('show');
			
				$('#practice-remain').html($practiceRemain);
			}
			
		} else {
			$(`#time-practice-${this.value}`).removeClass('show');
			$practiceRemain = + $(`#time-p-${this.value}`).val() + +$practiceRemain;
			$('#practice-remain').html($practiceRemain)
			$(`#time-p-${this.value}`).val(1);
			
		}
	});
	
		
	 //    $.ajax({
	 //    // traditional: true,
		//   method: 'POST',
		//    url: '/site/lab-time-validate',
		//    dataType: 'json',
		//    data: JSON.stringify({'time':$timeValue, 'remain':$remainforCompare, [csrfParam]:$csrfToken}),
		//    //data: JSON.stringify({'time':$timeValue, 'remain':$labRemain, $csrfParam:$csrfToken}),
		//    contentType: "application/json; charset=utf-8",
		//    success: function(data){
		//    		if(data.success){
		//      		$('#hide-error').removeClass('show');
		     		
		//      		$('#lab-remain').html($remain); 
		//    		} else {
		//    			$('#hide-error').addClass('show');
		//    		}
		// 	}
		// });


	// $('.delete-section').on('click', function () {
	// 	var csrfParam = $('meta[name="csrf-param"]').attr("content");
	// 	var $csrfToken = $('meta[name="csrf-token"]').attr("content");
	//     // отправляем данные на сервер
	//     $.ajax({
 //            type: 'POST',
 //            url: $(this).attr('href'),
 //            dataType: 'json',
 //            data: JSON.stringify({[csrfParam]:$csrfToken}),
 //            contentType: "application/json; charset=utf-8",
 //            success: function( data, status, xhttp) {
 //             // data will be true or false if you returned a json bool
 //                if(data.success) {
 //                  $(`tr[data-id-section="${data.id_section}"]`).remove();
 //                  $.pjax.reload("#pj-section", {timeout : false}) ;
 //                }else{
 //                	alert('eee');
 //                }
 //            },
 //            error: function(request, status, error) {
 //            	alert(request);
 //            	alert(status);
 //            	alert(error);
 //            }
 //        });
 //        return false;
	// });
	// $('.classroom-update').on('click', function () {
	// 	$.pjax.reload("#pj-classroom", {timeout : false}) ;
	// });

	var tabs$ = $(".nav-tabs a");

	$( window ).on("hashchange", function() {
    	var hash = window.location.hash, // get current hash
        menu_item$ = tabs$.filter('[href="' + hash + '"]'); // get the menu element

    	menu_item$.tab("show"); // call bootstrap to show the tab
	}).trigger("hashchange");

});

// function courseSelect(){
// 	var coursesList = document.getElementsByClassName('courses');
// 	var $currentCourse = $('.disciplines').attr('id');

// 	//alert($currentCourse);
// 	for(var i = 0; i<coursesList.length; i++){
// 		if(coursesList[i].getAttribute('data-course')  == $currentCourse){
// 			coursesList[i].classList.add('selectedCourse');
// 		} else {
// 			coursesList[i].classList.remove('selectedCourse');
// 		}
// 	}
// };

function showForm(){

	var controls = document.getElementsByName("sectionControls[]");

	for (var i = 0; i < controls.length; i++) {
		if(controls[i].value == '2') {

			if(controls[i].checked) {

				$('#task-form').addClass('show');

			} else {
				$('#task-form').removeClass('show');
				$('#section-task').val('');
			
			}
			
		} else if (controls[i].value == '3') {
			if(controls[i].checked) {
				$('#test-form').addClass('show');
			} else {
				$('#test-form').removeClass('show');
				$('#section-task').val('');
			}
		} else if (controls[i].value == '5') {
			if(controls[i].checked) {
				$('#checkboxLabs').addClass('show');
			} else {
				$('#checkboxLabs').removeClass('show');
				var $sectionLabs = $("input.sectionLabs")
				$sectionLabs.prop("checked",false);
				$('.hide-input-time-lab').removeClass('show');
			}
		} else if (controls[i].value == '4') {
			if(controls[i].checked) {
				$('#checkboxPractices').addClass('show');
			} else {
				$('#checkboxPractices').removeClass('show');
				var $sectionPractices = $("input.sectionPractices")
				$sectionPractices.prop("checked",false);
				$('.hide-input-time-practice').removeClass('show');
			}
		}
	}
};

function showInputTimeOnReady(){

	var labs = document.getElementsByName("sectionLabs[]");
	var practices = document.getElementsByName("sectionPractices[]");
	for (var i = 0; i < labs.length; i++) {
		if(labs[i].checked) {
			// alert(`#time-${x[i].value}`);
			$(`#time-lab-${labs[i].value}`).addClass('show');

		} else {
			$(`#time-lab-${labs[i].value}`).removeClass('show');
			$(`#time-l-${labs[i].value}`).val(1);
		}
	}
	for (var i = 0; i < practices.length; i++) {
		if(practices[i].checked) {
			// alert(`#time-${x[i].value}`);
			$(`#time-practice-${practices[i].value}`).addClass('show');
		} else {
			$(`#time-practice-${practices[i].value}`).removeClass('show');
			$(`#time-p-${practices[i].value}`).val(1);
		}
	}

}
