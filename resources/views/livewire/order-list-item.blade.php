<div class="row" :write:key="{{$item['id']}}"> <!-- ITEM ROW -->
    <div class="col-md-2">
      <img class="img-rounded" alt="" src="{{$item['image']}}" >
    </div>
    <div class="col-md-6">
            <div class="row">
                <p><strong> {{$item['title']}} </strong></p>
            </div>
          <div class="row" style="color: gray;">
            <p>${{$price}}</p>

          </div>
    </div>
    <div class="col-md-2">
        <select wire:model='quantity' class="form-control" id="exampleFormControlSelect1">
            @for ($i = 0; $i < $item['quantity']+1; $i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-1">
      <button class="btn btn-secondary" wire:click="testingEvent" type="button">Test</button>
    </div>
    <div class="col-md-2">
        <p><strong>${{$amount}}</strong></p>
    </div>
  </div> <!-- END ITEM ROW -->