<div wire:ignore.self class="modal fade" id="modalRefund">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        @if ($this->refundResponse['status'] == "ok")
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{$this->refundResponse['message']}}
        </div>
        @endif
        @if($this->refundResponse['status'] == "error")  
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{$this->refundResponse['message']}}
        </div>
        @endif

        <h3>Refund Order {{$orderNumber}}</h3>
        <span class="text-right" wire:loading><i class="fa fa-circle-o-notch fa-spin"></i></span>
      </div>

      <div class="modal-body background-gray">
        <div class="container-fluid">          
          <div class="row">
            <div class="col-md-8 marginright-1">
            <div class="box-container row-margenes">
              @foreach ($orderItems as $item)
              <div class="row d-flex" :write:key="{{$loop->index}}"> <!-- ITEM ROW -->
                <div class="col-md-2">
                  <img class="img-rounded" alt="" src="{{$item['image']}}" >
                </div>
                <div class="col-md-6">
                        <div class="row">
                            <p class="marginbottom-0"><strong> {{$item['title']}} </strong></p>
                        </div>
                      <div class="row" style="color: gray;">
                        <p>${{$item['price']}}</p>
            
                      </div>
                </div>
                <div class="col-md-2 margin-auto">
                    <select wire:change='updateSelectedItems("{{$item['id']}}", $event.target.value, "{{$item['price']}}")' class="form-control" id="exampleFormControlSelect1">
                        @for ($i = 0; $i < $item['quantity']+1; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 margin-auto">
                    <p><strong>${{$item['amount'] ?? 0}}</strong></p>
                </div>
              </div> <!-- END ITEM ROW -->
              @endforeach
              </div>

              <div class="row box-container">
                <div class="">
                  <label class="marginbottom-2" for="internalNote">Internal Note</label>
                  <input wire:model="orderNote" type="text" class="form-control marginbottom-5" id="internalNote" placeholder="This is an internal note that assists in the reason for return.">
                  <p class="color-gris"> Will not be shared with the customer </p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              
                <div class="row box-container">
                  <label class="cabecero-1"for="inputEmailCustomer" style="width:100%;">Customer Email</label>
                  <input type="email" wire:model='customerEmail' class="form-control" id="inputEmailCustomer" placeholder="email@mail.com">
                </div>

                <div class="row box-container-1">
                  <div class="col-md-12 padding-0">
                    <div class="padding-container-1 border-1">
                      <h3 class="cabecero-2">Summary</h3>
                      <!-- Aqui empiezan los textos -->
                      <div class="d-flex">
                        <div class="texto-izquierda marginright-auto">
                          <h5 >Items Subtotal</h5>
                          <p>{{$itemsCount}} Item(s)</p>
                        </div>
                        <div class="texto-derecha">
                          <p>0</p>
                        </div>
                      </div>
                      <div class="d-flex">
                          <p class="marginright-auto">tax</p>
                          <p>0</p>
                      </div>
                      <div class="d-flex">
                          <p class="marginright-auto">shipping</p>
                          <p>0</p>
                      </div>
                      <div class="d-flex">
                          <p class="marginright-auto">total</p>
                          <p>0</p>
                      </div>
                      <!-- Aqui terminan -->
                    </div>
                    <div class="paddingtop-1 padding-container-1 border-1">
                      <div class="d-flex">
                        <input type="checkbox" name="tax">
                        <h5>Tax</h5>
                      </div>
                      <div class="d-flex">
                        <input type="checkbox" name="shipping">
                        <h5>Shipping</h5>
                      </div>
                    </div>
                    <div class="padding-container-1">
                      <button class="btn btn-primary" wire:click="refundWithInstntly" >Refund Order</button>
                    </div>
                  </div> <!-- CONTAINER -->
                </div> <!-- ROW -->      
            </div>
          </div>
      </div>
    </div>

      <div class="modal-footer">
        
      </div>

    </div><!-- .modal-content -->
  </div><!-- .modal-dialog -->
</div>