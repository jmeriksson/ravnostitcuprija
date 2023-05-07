import Swiper, { Pagination } from 'swiper'
import 'swiper/css'
import 'swiper/css/pagination'

document.addEventListener('DOMContentLoaded', () => {
	const swiper1234Instances = document.querySelectorAll('.swiper-1234')
	swiper1234Instances.forEach( element => {
		new Swiper(element, {
			direction: 'horizontal',
			loop: false,
			modules: [Pagination],
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
			},
			slidesPerView: 1,
			spaceBetween: 16,
			breakpoints: {
				576: {
					slidesPerView: 2,
					spaceBetween: 16,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 16,
				},
				960: {
					slidesPerView: 4,
					spaceBetween: 32,
				}
			}
		})
	})

	const swiper1223Instances = document.querySelectorAll('.swiper-1223')
	swiper1223Instances.forEach( element => {
		new Swiper(element, {
			direction: 'horizontal',
			loop: false,
			modules: [Pagination],
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
			},
			slidesPerView: 1,
			spaceBetween: 16,
			breakpoints: {
				576: {
					slidesPerView: 2,
					spaceBetween: 16,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 16,
				},
				960: {
					slidesPerView: 3,
					spaceBetween: 32,
				}
			}
		})
	})
})
