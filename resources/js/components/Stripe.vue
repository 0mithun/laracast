<template>
    <div class=" text-center">
        <button class="btn btn-primary"  @click="subscribe('monthly')">Subscribe to $9.99 Monthly</button>
        <button class="btn btn-success" @click="subscribe('yearly')">Subscribe to $99.99 Yearly</button>



        <div class="modal" id="payment-modal">
            <div class="modal-dialog"  style="min-width: 450px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Pay with stripe</h3>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                            <form action="" method="post" id="payment-form">
                                <div class="form-row" >
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                </div>
                            
                                <div id="card-errors" role="alert"></div>
                                </div>
                            
                                <br>
                                <button class="btn btn-primary" type="submit">Submit Payment</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">       
            
        </div>
    </div>
</template>

<script>
   
import axios from 'axios'
import swal from 'sweetalert'
export default {
    props:['email'],
    mounted() {

    },
    data() {
        return {
            plan: '',
            amount: 0,
            handler : null,
            paymentform: false
        }
    },
    methods: {
        subscribe(plan) {
            if(plan == 'monthly'){
                this.plan = 'monthly'
                this.amount = 999
                this.paymentform = true
                $('#payment-modal').modal();
                this.payment()
            }
            else if(plan == 'yearly'){
                this.plan = 'yearly'
                this.amount = 9999
                this.paymentform = true
                $('#payment-modal').modal();
                this.payment()
            }

        },
        payment(){
            const stripe = Stripe('pk_test_TZWtnQzo91rt7E0jbhcTqwcK00QQTfyG5m');
            const elements = stripe.elements();
            const style = {
                base: {
                    fontSize: '16px',color: "#32325d",
                },
            };
            const card = elements.create('card', {style});
            card.mount('#card-element');

            card.addEventListener('change', ({error}) => {
                const displayError = document.getElementById('card-errors');
                if (error) {
                    displayError.textContent = error.message;
                } else {
                    displayError.textContent = '';
                }
            });


            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const {token, error} = await stripe.createToken(card);

                if (error) {
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    // this.stripeTokenHandler(token);
                    swal({text:'Please wait while we subscribed to a plan', buttons:false});
                    axios.post('/subscribe',{
                        stripeToken: token.id,
                        plan: this.plan
                    })
                    .then(res=>{
                        swal({text:'Successfully Subscription', icon:'success'})
                        .then(()=>{
                            $('#payment-modal').modal('hide');
                            window.location = ''
                        });
                    })
                    .catch(err=>{
                        swal({text:'Subscription Failed', icon:'error'});
                    })
                }
            });
        },
        stripeTokenHandler(token){
                const form = document.getElementById('payment-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
    },
}
</script>

<style scoped>
    .form-row{
        display: block;
    }
    .StripeElement {
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
    border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
    }

    .modal {
    text-align: center;
    padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>

