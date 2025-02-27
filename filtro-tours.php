<php?

function filtro_tours() {
    if ( is_page('tours-en-el-calafate') ) {
        ?>
        <script>
		document.addEventListener('DOMContentLoaded', function() {
			const categoryButtons = document.querySelectorAll('.category-btn');
			const tours = document.querySelectorAll('.ex-modern-blog');
			const toursAb = document.querySelectorAll('.item-post-n');
			const gridContainer = document.querySelector('.grid-container');
			const applyFiltersButton = document.getElementById('apply-filters');
			const modalFiltro = document.getElementById('modalFiltro');
			const categoryQtySpan = document.querySelector('.category-qty');
			const botonFiltrar = document.querySelector('.filter-btn');
			const botonClear = document.querySelector('.filter-clear');
			
			gridContainer.style.display = "flex";
			gridContainer.style.flexWrap = "wrap";

			let selectedCategories = new Set();
		
			function countMatches() {
			let matchCount = 0;
			const selectedArray = Array.from(selectedCategories);

			tours.forEach(tour => {
			  const tourCategory = tour.getAttribute('tour-category').split(' ');
			  const isMatch = selectedArray.every(category => tourCategory.includes(category));
			if(selectedArray.length > 0){
			  if (isMatch) {
				matchCount++;
			  }
			}
			});
			toggleApplyFiltersButton(matchCount);
			categoryQtySpan.textContent = `(${matchCount})`;
		  	}
			function toggleApplyFiltersButton(matchCount) {
			const hasActiveCategory = document.querySelectorAll('.category-btn.active').length > 0;

				if (hasActiveCategory && matchCount > 0) {
				  applyFiltersButton.classList.add('active');
				} else {
				  applyFiltersButton.classList.remove('active');
				}
			  }
			
			categoryButtons.forEach(button => {
				button.addEventListener('click', function() {
					const category = this.getAttribute('data-category');
					if (this.classList.contains('active')) {
						this.classList.remove('active');
						selectedCategories.delete(category);
					} else {
						this.classList.add('active');
						selectedCategories.add(category);
					}
				countMatches();
				});
			});
			
			
			botonClear.addEventListener('click', function() {
				tours.forEach(tour =>{
					tour.style.visibility = 'visible';
					tour.style.position = 'static';
					tour.style.display = 'block';					
				})
				toursAb.forEach(tour =>{
					tour.style.visibility = 'visible';
					tour.style.position = 'static';
					tour.style.display = 'block';					
				})			
			});

				
			applyFiltersButton.addEventListener('click', function() {
				gridContainer.style.height = "auto";

				tours.forEach(tour => {
					const tourCategory = tour.getAttribute('tour-category').split(' ');
					const selectedArray = Array.from(selectedCategories); 

					if (selectedArray.length === 1) {
						const isMatch = selectedArray.some(category => tourCategory.includes(category));
						if (isMatch) {
							botonFiltrar.classList.add('active');
							const closestItemPost = tour.closest('.item-post-n');
								if (closestItemPost) {
									closestItemPost.style.visibility = 'visible';
									closestItemPost.style.position = 'static';
									closestItemPost.style.display = 'block';
								} else {
									tour.style.visibility = 'visible';
									tour.style.position = 'static';
									tour.style.display = 'block';									
								}	
						} else {
							botonFiltrar.classList.remove('active');
							const closestItemPost = tour.closest('.item-post-n');
								if (closestItemPost) {
									closestItemPost.style.visibility = 'hidden';
									closestItemPost.style.position = '';
									closestItemPost.style.display = 'none';
								} else {
									tour.style.visibility = 'hidden';
									tour.style.position = '';
									tour.style.display = 'none';									
								}
						}
					} else if (selectedArray.length > 1) {				
						const isMatch = selectedArray.every(category => tourCategory.includes(category));
						if (isMatch) {
							botonFiltrar.classList.add('active');
							const closestItemPost = tour.closest('.item-post-n');
							if (closestItemPost) {
									closestItemPost.style.visibility = 'visible';
									closestItemPost.style.position = 'static';
									closestItemPost.style.display = 'block';
								}	
						} else {
							botonFiltrar.classList.remove('active');
							const closestItemPost = tour.closest('.item-post-n');
								if (closestItemPost) {
									closestItemPost.style.visibility = 'hidden';
									closestItemPost.style.position = '';
									closestItemPost.style.display = 'none';
								} else {
									tour.style.visibility = 'hidden';
									tour.style.position = '';
									tour.style.display = 'none';									
								}
						}
					} else {
						botonFiltrar.classList.add('active');
						const closestItemPost = tour.closest('.item-post-n');
								if (closestItemPost) {
									closestItemPost.style.visibility = 'visible';
									closestItemPost.style.position = 'static';
									closestItemPost.style.display = 'block';
								} else {
									tour.style.visibility = 'visible';
									tour.style.position = 'static';
									tour.style.display = 'block';									
								}	
					}
				});
			modalFiltro.style.visibility = 'hidden';
			botonFiltrar.classList.remove('active');
			
			});		
		});
        </script>
		
		<script>
jQuery(document).ready(function($){
  function openModal() {
    $("#modalFiltro").css({
      "opacity": "1",
      "visibility": "visible",
      "transition": "opacity 0.5s ease"
    });
    $(".filter-btn").addClass('active');
  }

  function closeModal() {
    $("#modalFiltro").css({
      "opacity": "0",
      "transition": "opacity 0.5s ease"
    });

    setTimeout(function() {
      $("#modalFiltro").css({
        "visibility": "hidden"
      });
    }, 500); 
    $(".filter-btn").removeClass('active');
  }

  $(".filter-btn").on('click', function(){
    if ($(this).hasClass('active')) {
      closeModal();
    } else {
      openModal();
    }
  });

  $(window).on('click', function(event){
    if ($(event.target).is("#modalFiltro")) {
      closeModal();
    }
  });

  $(".close-filter").on('click', function(){
    closeModal();
  });
});

		</script>
		<script>
		document.getElementById('search').addEventListener('input', function() {
		  let query = this.value.toLowerCase();
		  let cards = document.querySelectorAll('.ex-modern-blog');
		  const gridContainer = document.querySelector('.grid-container');
	      gridContainer.style.height = "auto";
		 
			cards.forEach(function(card) {
			let productName = card.querySelector('h2').textContent.toLowerCase();
			
			if (productName.includes(query)) {
				card.style.visibility = 'visible';
				card.style.position = 'static'; 
				card.style.display = 'block';
			} else {
			    card.style.display = 'none';
				card.style.visibility = 'hidden';
				card.style.position = '';
			}
		  });
		});
		</script>
		<script>
			const search = document.getElementById('search');
			const svg = document.querySelector('.search-btn svg');
			const orden = document.querySelector('.orden-btn');
			const container = document.querySelector('.search-btn'); 

			svg.addEventListener('click', function() {
			  svg.classList.toggle('abierto');
			  search.classList.toggle('active');
			  orden.classList.toggle('op');
			});

			document.addEventListener('click', function(event) {
			  if (!container.contains(event.target) && svg.classList.contains('abierto')) {
				svg.classList.remove('abierto');
				search.classList.remove('active');
				orden.classList.remove('op');
			  }
			});
		</script>
		<script>
		var firstClick = true;

		document.querySelector('.orden-btn').addEventListener('click', function () {
		  const modal = document.getElementById('modal-orden');
		  modal.classList.add('open');
			if(modal.classList.contains('open') && !firstClick){
				modal.classList.remove('open');
				firstClick = true;
				return
			}
		  setTimeout(() => {
			firstClick = false; 
		  }, 100); 

		});

		document.addEventListener('click', function(event) {
		  const modal = document.getElementById('modal-orden');
		  if (!modal.contains(event.target) && !firstClick) {
			modal.classList.remove('open');
			firstClick = true;
		  }
		});


		const productCards = Array.from(document.querySelectorAll('.ex-modern-blog'));
		const getPriceFromCard = (card) => {
		  const priceElement = card.querySelector('.woocommerce-Price-amount bdi');
		  if (!priceElement) return 0;

		  const priceText = priceElement.innerText.replace(/[^\d,.-]/g, '');
		  return parseFloat(priceText.replace(',', '.'));
		};
		const getDurFromCard = (card) => {
		  const durationElement = card.querySelector('.tour-duration');
		  if (!durationElement) return 0;

		  const durationText = durationElement.innerText;

		  const match = durationText.match(/(\d+([.,]?\d+)?)/);
		  if (match) {
			return parseFloat(match[0].replace(',', '.'));
		  }
		  return 0;
		};		
			
		const ordenarPorPrecioMayor = () => {
		  productCards.sort((a, b) => {
			const priceA = getPriceFromCard(a);
			const priceB = getPriceFromCard(b);
			//console.log(`El precio de A es ${priceA} y el de B es ${priceB}`);
			return priceB - priceA;
		  });
		  const productContainer = document.querySelector('.grid-container');
		  productContainer.innerHTML = '';
		  productCards.forEach(card => {
			    card.style.marginBottom = '33px';
   				card.style.maxWidth = '400px';				   
			productContainer.appendChild(card)});
		};
		const ordenarPorPrecioMenor = () => {
		  productCards.sort((a, b) => {
			const priceA = getPriceFromCard(a);
			const priceB = getPriceFromCard(b);
			//console.log(`El precio de A es ${priceA} y el de B es ${priceB}`);
			return priceA - priceB;
		  });
		  const productContainer = document.querySelector('.grid-container');
		  productContainer.innerHTML = '';
		  productCards.forEach(card => {
			    card.style.marginBottom = '33px';
   				card.style.maxWidth = '400px';				   
			productContainer.appendChild(card)});
		};
		
		const ordenarDuracion = () => {
		  productCards.sort((a, b) => {
			const durA = getDurFromCard(a);
			const durB = getDurFromCard(b);
			//console.log(`El precio de A es ${priceA} y el de B es ${priceB}`);
			return durA - durB;
		  });
		  const productContainer = document.querySelector('.grid-container');
		  productContainer.innerHTML = '';
		  productCards.forEach(card => {
			    card.style.marginBottom = '33px';
   				card.style.maxWidth = '400px';				   
			productContainer.appendChild(card)});
		};

		let selectedFilter = ''; 
		const applyOrdenBtn = document.getElementById('apply-orden');
		document.querySelectorAll('input[type="radio"][name="filtro"]').forEach((radio) => {
		  radio.addEventListener('change', function() {
			selectedFilter = this.value; 
		     if (selectedFilter) {
			  applyOrdenBtn.classList.add('active');
			} else {
			  applyOrdenBtn.classList.remove('active'); 
			}
		  });
		});

		document.getElementById('apply-orden').addEventListener('click', function() {
		  const productContainer = document.querySelector('.grid-container');
		  if (selectedFilter === 'precio-alto') {
			ordenarPorPrecioMayor();
		  } else if (selectedFilter === 'precio-bajo') {
			ordenarPorPrecioMenor();
		  } else if (selectedFilter === 'duracion') {
			ordenarDuracion();
		  }
		  const modal = document.getElementById('modal-orden');
		  modal.classList.remove('open');
		  productContainer.style.height = 'auto';
		  productContainer.style.justifyContent = 'space-between';
			
		});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
			const allowedIds = ['id58808', 'id58666', 'id58797', 'id62176', 'id58660'];
			allowedIds.forEach(function (id) {
				const parentElement = document.querySelector(`.item-post-n#${id}`);
				if (parentElement) {
					const targetElement = parentElement.querySelector('.image');
					if (targetElement) {
						const htmlContent = `<div class="woocommerce-wt-onsale eco"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none"><path d="M13.0089 6.72886L11.4524 2.45559L8.65141 7.683L6.57518 5.66507L4.82549 10.2772L4.80463 11.8348L2.53247 10.7013L0.28572 13.1596L0 12.5036L1.75151 9.44541L3.81322 9.06484L5.69353 4.10564L8.73667 4.66381L11.1784 0L16.2017 5.96137C15.8271 5.95322 15.4524 5.97224 15.0833 6.01936C14.3477 6.10001 13.6347 6.34466 13.0089 6.72886Z" fill="white"/><path d="M23 8.28835L22.8694 8.95616C22.8358 9.06671 22.5628 10.4205 21.8009 11.863C21.4372 12.5517 20.9628 13.2602 20.3505 13.8628C19.5478 14.6529 18.5092 15.261 17.174 15.4068C16.7686 15.4503 16.3622 15.4521 15.9586 15.4132C15.555 15.3751 15.1758 15.3017 14.7958 15.1885C13.9649 14.9529 13.2075 14.5143 12.5944 13.9108C12.2198 14.5995 11.895 15.3126 11.6211 16.0466L10.5717 15.7349C10.8338 14.903 11.173 14.0993 11.5839 13.33C11.9839 12.5607 12.4955 11.8539 13.105 11.2332C13.2248 11.1218 13.349 11.0149 13.4778 10.9143C13.6837 10.7503 13.9014 10.6008 14.1273 10.4649C14.5073 10.2483 14.9146 10.0807 15.3382 9.96558C16.121 9.74902 16.9391 9.67743 17.7509 9.75446C17.8507 9.76352 17.9514 9.7753 18.0512 9.78979C17.594 9.63485 17.1223 9.53427 16.6452 9.48896C16.1681 9.44366 15.7092 9.45362 15.2429 9.51614C14.3078 9.64028 13.4243 10.0036 12.6824 10.5727C12.6488 10.5971 12.6152 10.6234 12.5817 10.6506C12.2379 10.9433 11.9186 11.2604 11.6247 11.6011C11.5748 10.7639 11.7463 9.92843 12.1227 9.17907C12.4121 8.60187 12.8429 8.10713 13.3762 7.73834C13.3799 7.73562 13.3826 7.73381 13.3862 7.73109C13.925 7.36139 14.55 7.12942 15.2048 7.05875C15.6874 6.99622 16.1736 6.98897 16.6534 7.03519V7.037C17.4117 7.10858 18.1537 7.30974 18.8485 7.63776C19.2403 7.81354 19.6448 7.95581 20.0575 8.06273C20.4576 8.16784 20.8657 8.24033 21.2775 8.27838C21.6186 8.311 21.9633 8.32097 22.3088 8.30738L23 8.28835Z" fill="white"/></svg><span>Aventura Sustentable</span></div>`;
						targetElement.insertAdjacentHTML('beforeend', htmlContent);
					}
				}
			});
			});
		</script>
        <?php
    }
}
add_action('wp_footer', 'filtro_tours');
