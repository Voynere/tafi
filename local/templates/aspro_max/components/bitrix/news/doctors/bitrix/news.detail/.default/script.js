document.addEventListener('DOMContentLoaded', function() {
    let doctorTabs = document.querySelectorAll('.doctor-detail__tab')
    if (doctorTabs) {
        doctorTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tab.classList.toggle('active')
            })
        })
    }
})