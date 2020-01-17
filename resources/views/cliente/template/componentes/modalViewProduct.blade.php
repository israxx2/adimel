<div class="modal fade modal-wrapper" id="exampleModalCenter" >
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-inner-area row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<!-- Product Details Left -->
						<div class="product-details-left">
						
							@if (file_exists('uploads/productos/'.$productos->first()->pro_idn.'.png'))
								<img src="{{ asset('uploads/productos/'.$productos->first()->pro_idn.'.png') }}" width="240px" height="240px" alt="Product Image">
							@else
								<img src="{{ asset('uploads/productos/noimage.png') }}" width="240px" height="240px" alt="Product Image">
							
							@endif
					

						</div>
						<!--// Product Details Left -->
					</div>

					<div class="col-lg-8 col-md-6 col-sm-6">
						<div class="product-details-view-content pt-60">
							<div class="product-info">
								<h2>{{$productos->first()->pro_nombre}}</h2>
								<div class="price-box pt-20">
									<span class="new-price new-price-2">${{$productos->first()->pro_valor_venta1}}</span>
								</div>
								<div class="product-desc">
									<p>
										<span>{{$productos->first()->pro_nombre}}</span>
									</p>
								</div>

								<div class="single-add-to-cart">
									<form action="#" class="cart-quantity">
										<div class="quantity">
											<label>Cantidad</label>
											<div class="cart-plus-minus">
												<input class="cart-plus-minus-box" value="1" type="text">
												<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
												<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
											</div>
										</div>
										<button class="add-to-cart" type="submit" style="color:white">Añadir</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>