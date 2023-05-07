document.addEventListener('DOMContentLoaded', () => {
	const showFiltersBtn = document.querySelector("#js-dog-archive-filter-button")
	const filterFormWrapper = document.querySelector("#js-filtering-form-wrapper")
	const filterForm = document.querySelector('#dog-archvive-filter-form')

	showFiltersBtn.addEventListener('click', event => {
		event.preventDefault()
		filterFormWrapper.classList.toggle('hidden')
	})

	filterFormWrapper.addEventListener('click', event => {
		if(event.target.classList.contains('filtering-form-wrapper')) {
			filterFormWrapper.classList.toggle('hidden')
		}
	})

	filterForm.addEventListener('submit', event => {
		filterFormWrapper.classList.toggle('hidden')
	})
})
