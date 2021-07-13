@extends('layouts._layout')

@section('title', 'Thanh toán')

@section('content')
    
<!-- Main content -->
<section class="container" style="margin-top: 90px;">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="{{asset('assets/images/tickets.png')}}">
            <p class="order__title">
                {{ $film->Name }}
                <br>
                <span style="font-size: 17px;">Đạo diễn: </span><span class="order__descript">{{ $film->Director }}</span>
                <br>
                <span style="font-size: 17px;">Diễn viên: </span><span class="order__descript">{{ $film->Actor }}</span>
            </p>
        </div>
    </div>
    <div class="order-step-area">
        <div class="order-step first--step order-step--disable ">1. Chọn Ngày &amp; Giờ</div>
        <div class="order-step second--step order-step--disable">2. Chọn vị trí ngồi &amp; đồ ăn vặt</div>
        <div class="order-step third--step">3. Thanh toán</div>
    </div>

    <div class="col-sm-12">
        <div class="checkout-wrapper">
            <h2 class="page-heading">Tổng tiền:</h2>

            <div class="row">
                <ul class="book-result">
                    {{-- <li class="book-result__item">Số vé: <span class="book-result__count booking-ticket">{{ $booksit[$user_id]['CountTicket'] }}</span></li> --}}
                    <li class="book-result__item col-md-4">Mỗi vé: <span class="book-result__count booking-price">{{ number_format($ticket->TicketPrice) }} ₫</span></li>
                    <li class="book-result__item col-md-4">Số ghế: <span class="book-result__count booking-ticket">{{ $booksit[$user_id]['CountTicket'] }}</span></li>
                    <li class="book-result__item col-md-4">Thành tiền: <span class="book-result__count booking-price">{{ number_format($ticket->TicketPrice * $booksit[$user_id]['CountTicket']) }} ₫</span></li>

                    
                    <li class="book-result__item col-md-8">Thông tin ghế: <span class="book-result__count booking-ticket">{{ $booksit[$user_id]['Sit'] }}</span></li>
                    <li class="book-result__item col-md-4">Thành tiền: <span class="book-result__count booking-price">{{ number_format($booksit[$user_id]['TotalPrice']) }} ₫</span></li>

                    <li class="book-result__item col-md-8">Bắp & nước uống: 
                        <span class="book-result__count booking-ticket">
                            @if($food_drink != null)
                                @foreach($food_drink as $key=>$value)
                                    {{ $value['NameFood'] }} x {{ $value['Quantity'] }} ,
                                @endforeach
                            @else
                                Không
                            @endif
                            
                        </span>
                    </li>

                    <li class="book-result__item col-md-4">Thành tiền: <span class="book-result__count booking-price">{{ number_format($TotalFoodDrink) }} ₫</span></li>
                    <li class="book-result__item col-md-12">Tổng thanh toán: <span class="book-result__count booking-cost">{{ number_format($TotalMoney) }} ₫</span></li>
                </ul>
            </div>
            

            <h2 class="page-heading">Chọn ngân hàng thanh toán</h2>
            <div class="row payment col-md-10">

                @for($i = 1 ; $i <= 16 ; $i++)
                <a href="javascript:void(0)" class="payment__item">
                    <img alt='' src="{{asset('assets/images/payment/bank_'. $i . '.png')}}">
                </a>
                @endfor
            </div>
            <div class="col-md-12">
                @if(Session::get('error') != null)
                <div class="alert alert-danger text-center">
                    {{ Session::get('error') }}
                </div>
                @endif
            </div>
            <div class="row col-md-12" id="CartPay" style="display: none;">
                <h2 class="page-heading">Nhập số thẻ và thanh toán</h2>


                <form action="/book/payment" id="contact-info" method="post" novalidate="" class="form contact-info">
                  {{ csrf_field() }}

                    
                    <div class="login">

                        <div class="field-wrap">
                            <input type="hidden" value="{{ $TotalMoney }}" name="TotalMoney">
                            <input type="hidden" value="{{ $film->ID }}" name="Film_ID">
                            <input type="text" placeholder="Nhập số thẻ" name="CardNumber" class="login__input" required>
                            <div class="col-sm-4">
                                <label style="margin-top: 3px;">Ngày phát hành</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="Month" class="login__input" placeholder="Tháng" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text"  name="Year" class="login__input" placeholder="Năm" required>
                            </div>
                            <input type="text" placeholder="Tên in trên thẻ" name="NameCard" class="login__input" required>
                        </div>

                        <div class="login__control">
                            <button type="submit" class="btn btn-md btn--warning btn--wider">Thanh toán</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

        {{-- <div class="order">
            <a href="book-final.html" class="btn btn-md btn--warning btn--wide">purchase</a>
        </div> --}}

    </div>

</section>


<div class="clearfix"></div>

{{-- <div class="booking-pagination">
    <a href="{{ url()->previous() }}" class="booking-pagination__prev">
        <p class="arrow__text arrow--prev">Quay lại</p>
        <span class="arrow__info">Chọn ngày &amp; giờ</span>
    </a>
</div> --}}
    
@endsection

@section('jsSection')
    <script>
        $(function(){

            $('.payment__item').click(function (){
                    $('#CartPay').removeAttr('style');
                    $('#CartPay').attr('display', 'block');
                });
        });
    </script>
@endsection