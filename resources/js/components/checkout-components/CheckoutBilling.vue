<template lang="">
    <div class="axil-checkout-billing">
                                <h4 class="title mb--40">Billing details</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>First Name <span>*</span></label>
                                            <input type="text" id="first-name" placeholder="Adam">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Last Name <span>*</span></label>
                                            <input type="text" id="last-name" placeholder="John">
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label> Region <span>*</span></label>
                                    <select id="Region">
                                        <option value="3">Wendani</option>
                                      
                                     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Street Address <span>*</span></label>
                                    <input type="text" id="address1" class="mb--15" placeholder="House number and street name">
                                    <input type="text" id="address2" placeholder="Apartment. (optonal)">
                                </div>
                              
                                
                                <div class="form-group">
                                    <label>Phone <span>*</span></label>
                                    <input type="tel" id="phone">
                                </div>
                                <div class="form-group">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" id="email">
                                </div>
                               
                               
                                <div class="form-group">
                                    <label>Other Notes (optional)</label>
                                    <textarea id="notes" rows="2" placeholder="Notes about your order, e.g. speacial notes for delivery."></textarea>
                                </div>
                            </div>
</template>
<script>
export default {
    
}
</script>
<style lang="">
    
</style>