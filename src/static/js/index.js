
// open page navigation
const hamburgerMenu = document.querySelector(".hamburger")
hamburgerMenu.addEventListener('click', function () {
    document.querySelector('.nav-container').classList.remove('nav-closed');
    document.querySelector('.nav-container').classList.add('nav-opened');
    document.querySelector('body').classList.add('no-scroll')
})


//close page navigation
const navCloseBtn = document.querySelector(".close-nav")
navCloseBtn.addEventListener('click', function(){
    document.querySelector('.nav-container').classList.add('nav-opened');
    document.querySelector('.nav-container').classList.add('nav-closed');
    document.querySelector('body').classList.remove('no-scroll')
})



//jQuery triggers
$(document).ready(function(){
    //Data tables
	$('#default-table').DataTable({
		"pageLength": 7,
		"lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
		"ordering": false,
	});

	$('.just-table').DataTable({
		searching: false,
		paging: false,
		"ordering": false,
	});

	$('.plan-subscr-btn').click(function(){
		var planName = $(this).attr('data-plan-name')
		$('#selected-subcription-plan').val(planName)
	})

})