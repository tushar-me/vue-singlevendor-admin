<template>
    <div>

        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 font-weight-boldest mb-10">ORDER DETAILS</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="#" class="mb-5">
                                    <img src="@/assets/images/logos/logo-dark.png" alt="">
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
																	<span>Cecilia Chapman, 711-2880 Nulla St, Mankato</span>
																	<span>Mississippi 96522</span>
																</span>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="d-flex justify-content-between pt-6">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">ORDER DATE</span>
                                <span class="opacity-70">Jan 07, 2020</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">ORDER NO.</span>
                                <span class="opacity-70">64616-103</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">DELIVERED TO.</span>
                                <span class="opacity-70">Iris Watson, P.O. Box 283 8562 Fusce RD.
																<br>Fredrick Nebraska 20620</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="font-weight-boldest">
                                    <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                        <!--begin::Symbol-->
<!--                                        <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">-->
<!--                                            <div class="symbol-label" style="background-image: url('assets/media/products/11.png')"></div>-->
<!--                                        </div>-->
                                        <!--end::Symbol-->
                                        Street Sneakers</td>
                                    <td class="text-right pt-7 align-middle">2</td>
                                    <td class="text-right pt-7 align-middle">$90.00</td>
                                    <td class="text-primary pr-0 pt-7 text-right align-middle">$180.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>
                                    <th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
                                    <th class="font-weight-bold text-muted text-uppercase">PAYMENT DATE</th>
                                    <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="font-weight-bolder">
                                    <td>Credit Card</td>
                                    <td>Success</td>
                                    <td>Jan 07, 2020</td>
                                    <td class="text-primary font-size-h3 font-weight-boldest text-right">$789.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
        <!--end::Card-->

    </div>
</template>

<script>
export default {
    name: "ShowOrder"
}
</script>

<style scoped>

</style>
