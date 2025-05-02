// for the main page 

document.querySelectorAll('.list-service').forEach(button => {
    button.addEventListener('click', () => {
        alert('clicked');
    });
});

document.querySelector('.quick-start').addEventListener('click', () => {
    alert('Going to next page');
});

// property submissiipn
document.querySelector('.list-service').addEventListener('click', function() {
    alert('Redirecting to the next step!');
});



// car submission

document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    alert("Car details submitted successfully!");
    this.submit(); 
});