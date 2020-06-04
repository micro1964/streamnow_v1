import React, { Component } from "react";
import Sidebar from "../../layouts/sidebar/Sidebar";
import PaypalExpressBtn from "react-paypal-express-checkout";
import ToastContent from "../../helper/ToastContent";
import { withToastManager } from "react-toast-notifications";
import api from "../../../Environment";
import {
  injectStripe,
  CardElement,
  Elements,
  StripeProvider,
} from "react-stripe-elements";
import AddCardSec from "../AddCardSec";
import config from "react-global-configuration";

const $ = window.$;

class SubscriptionInvoiceIndex extends Component {
  state = {
    loadingInvoice: true,
    couponInputData: {},
    loadingCoupon: true,
    couponButtonDisable: false,
    couponButtonLoadingContent: null,
    couponData: null,
    paynowButtonDisable: false,
    paynowButtonLoadingContent: null,
    paymentMode: null,
    cardData: null,
    loadingCard: true,
    addCardLoadingContent: null,
    addCardButtonDisable: false,
    showAddCardButton: false,
    showPayPal: false,
  };
  componentDidMount() {
    if (this.props.location.state == null) {
      ToastContent(
        this.props.toastManager,
        "Payment details not found, please try again...",
        "error"
      );
      this.props.history.push("/subscription");
    }
    this.setState({ loadingInvoice: false });
    const couponInputData = { ...this.state.couponInputData };
    couponInputData[
      "subscription_id"
    ] = this.props.location.state.subscription_id;
    this.setState({ couponInputData });
  }

  removeCouponCode = (event) => {
    event.preventDefault();
    const couponInputData = { ...this.state.couponInputData };
    couponInputData["coupon_code"] = "";
    this.setState({ couponInputData });
    this.setState({
      couponData: null,
      loadingCoupon: true,
    });
    ToastContent(this.props.toastManager, "Coupon Code Removed", "error");
  };

  handleCouponChange = ({ currentTarget: input }) => {
    const couponInputData = { ...this.state.couponInputData };
    couponInputData[input.name] = input.value;
    this.setState({ couponInputData });
  };

  checkCouponCode = (event) => {
    event.preventDefault();

    this.setState({
      couponButtonDisable: true,
      couponButtonLoadingContent: "Loading...",
    });
    setTimeout(() => {
      this.couponCodeApi();
    }, 1000);
  };

  couponCodeApi = () => {
    api
      .postMethod("subscriptions_check_coupon_code", this.state.couponInputData)
      .then((response) => {
        if (response.data.success) {
          this.setState({
            couponData: response.data.data,
            loadingCoupon: false,
          });
          ToastContent(
            this.props.toastManager,
            "Applied successfully",
            "success"
          );
        } else {
          ToastContent(this.props.toastManager, response.data.error, "error");
        }
        this.setState({
          couponButtonDisable: false,
          couponButtonLoadingContent: null,
        });
      })
      .catch((err) => {
        // then print response status
        console.log("Error", err);
      });
  };

  choosePaymentOption = ({ currentTarget: input }) => {
    this.setState({ paymentMode: input.value });
    if (input.value == "card" && this.props.location.state.amount != 0) {
      if (this.state.cardData == null || this.state.cardData == [])
        this.listCardApi();
      ToastContent(
        this.props.toastManager,
        "Getting Card Details..",
        "success"
      );
      this.setState({ showPayPal: false });
    }
    if (input.value == "paypal") {
      this.setState({ showPayPal: true, showAddCardButton: false });
    }
  };

  listCardApi() {
    api.postMethod("cards_list").then((response) => {
      if (response.data.success) {
        this.setState({
          cardData: response.data.data,
          loadingCard: false,
        });
        if (response.data.data.cards.length > 0) {
          ToastContent(
            this.props.toastManager,
            "Got Card details, Click on Pay Now button to make the Payment.",
            "success"
          );
        } else {
          this.setState({ showAddCardButton: true });
          ToastContent(
            this.props.toastManager,
            "You haven't added any card. Please add card.",
            "error"
          );
        }
      } else {
        ToastContent(this.props.toastManager, response.data.error, "error");
      }
    });
  }

  cardAddedStatusChange = () => {
    this.setState({ showAddCardButton: false });
  };

  payNow = (event) => {
    event.preventDefault();
    this.setState({
      paynowButtonDisable: true,
      paynowButtonLoadingContent: "Payment Processing...",
    });
    api
      .postMethod("subscriptions_payment_by_card", this.state.couponInputData)
      .then((response) => {
        if (response.data.success) {
          ToastContent(
            this.props.toastManager,
            "Payment Successfull",
            "success"
          );
          this.props.history.push("/my-subscription-plans");
        } else {
          ToastContent(this.props.toastManager, response.data.error, "error");
        }
        this.setState({
          paynowButtonDisable: false,
          paynowButtonLoadingContent: null,
        });
      })
      .catch((err) => {
        console.log("Error", err);
      });
  };

  paypalOnSuccess = (payment) => {
    this.setState({
      paynowButtonDisable: true,
      paynowButtonLoadingContent: "Payment Processing...",
    });
    const couponInputData = { ...this.state.couponInputData };
    couponInputData["payment_id"] = payment.payment_id;
    this.setState({ couponInputData });
    setTimeout(() => {
      this.paypalPaymentAPI();
    }, 1000);
  };

  paypalPaymentAPI = () => {
    api
      .postMethod("subscriptions_payment_by_paypal", this.state.couponInputData)
      .then((response) => {
        if (response.data.success) {
          ToastContent(
            this.props.toastManager,
            "Payment Successfull",
            "success"
          );
          this.props.history.push("/my-subscription-plans");
        } else {
          ToastContent(this.props.toastManager, response.data.error, "error");
        }
        this.setState({
          paynowButtonDisable: false,
          paynowButtonLoadingContent: null,
        });
      })
      .catch((err) => {
        console.log("Error", err);
      });
  };

  paypalOnError = (err) => {
    ToastContent(this.props.toastManager, err, "error");
  };

  paypalOnCancel = (data) => {
    ToastContent(
      this.props.toastManager,
      "Payment cancelled please try again..",
      "error"
    );
  };

  render() {
    if (this.state.loadingInvoice) {
      return "Loading...";
    } else {
      const subscription = this.props.location.state;
      const {
        couponInputData,
        loadingCoupon,
        couponButtonDisable,
        couponButtonLoadingContent,
        couponData,
        paynowButtonDisable,
        paynowButtonLoadingContent,
        showAddCardButton,
        showPayPal,
      } = this.state;

      let env = "sandbox"; // you can set here to 'production' for production
      let currency = "USD"; // or you can set this value from your props or state
      let total; // same as above, this is the total amount (based on currency) to be paid by using Paypal express checkout
      if (!loadingCoupon) {
        total = couponData.user_pay_amount;
      } else {
        total = subscription.amount;
      }
      const client = {
        sandbox:
          "AaXkweZD5g9s0X3BsO0Y4Q-kNzbmLZaog0mbmVGrTT5IX0O73LoLVcHp17e6pkG7Vm04JEUuG6up30LD",
      };

      return (
        <div className="main">
          <Sidebar />
          <div className="sec-padding invoice left-spacing1">
            <div className="Spacer-5"></div>
            <div className="public-video-header">Invoice</div>
            <div className="Spacer-5"></div>
            <div className="row small-padding">
              <div className="invoice-bg">
                <div className="col-md-5">
                  <div className="invoice-image">
                    <img
                      src={window.location.origin + "/assets/img/invoice.svg"}
                    />
                  </div>
                </div>
                <div className="col-md-7">
                  <div className="invoice-box">
                    <div className="invoice-details">
                      <div className="invoice-media">
                        <div className="invoice-body">
                          <h4 className="invoice-heading">
                            {subscription.title}
                          </h4>
                          <p className="invoice-text">
                            {subscription.description}
                          </p>
                        </div>
                        <br />
                        <p className="invoice-text">
                          <b>Plan Type</b>&nbsp;-&nbsp;{subscription.plan_text}
                        </p>
                        {subscription.amount != 0 ? (
                          <>
                            <label>Coupon</label>
                            <div className="input-group padding-bottom-md half-invoice">
                              <input
                                type="text"
                                className="form-control"
                                placeholder="Coupon code"
                                name="coupon_code"
                                value={couponInputData.coupon_code}
                                onChange={this.handleCouponChange}
                              />

                              <span className="input-group-addon">
                                {couponData == null ? (
                                  <a
                                    href="#"
                                    onClick={this.checkCouponCode}
                                    disabled={couponButtonDisable}
                                  >
                                    {couponButtonLoadingContent != null
                                      ? couponButtonLoadingContent
                                      : "Apply"}
                                  </a>
                                ) : null}
                                {couponData != null ? (
                                  <a
                                    href="#"
                                    onClick={this.removeCouponCode}
                                    disabled={couponButtonDisable}
                                  >
                                    {couponButtonLoadingContent != null
                                      ? couponButtonLoadingContent
                                      : "Remove"}
                                  </a>
                                ) : null}
                              </span>
                            </div>
                          </>
                        ) : null}
                        <label>Price Details</label>
                        <div className="table-responsive half-invoice">
                          <table className="table table-bordered text-right">
                            <tbody>
                              <tr>
                                <td>Amount</td>
                                <td>
                                  {subscription.subscription_amount_formatted}
                                </td>
                              </tr>
                              {loadingCoupon ? null : (
                                <tr>
                                  <td>Coupon Code Amount</td>
                                  <td>{couponData.coupon_amount_formatted}</td>
                                </tr>
                              )}
                              <tr>
                                <td>Total Payable Amount</td>
                                <td>
                                  {loadingCoupon
                                    ? subscription.subscription_amount_formatted
                                    : couponData.user_pay_amount_formatted}
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div className="form-group size-16 mb-zero">
                          <div className="row">
                            <div className="col-md-12">
                              <label>Payment By:</label>
                            </div>
                            <div className="col-md-4">
                              <label className="custom-radio-btn">
                                Card
                                <input
                                  type="radio"
                                  name="payment_mode"
                                  value="card"
                                  onChange={this.choosePaymentOption}
                                />
                                <span className="checkmark"></span>
                              </label>
                            </div>
                            <div className="col-md-4">
                              <label className="custom-radio-btn">
                                PayPal
                                <input
                                  type="radio"
                                  name="payment_mode"
                                  value="paypal"
                                  onChange={this.choosePaymentOption}
                                />
                                <span className="checkmark choose-date-check"></span>
                              </label>
                            </div>
                            <div className="col-md-4"></div>
                          </div>
                        </div>

                        {showAddCardButton ? (
                          <div className="form-group size-16 mb-zero">
                            <div className="row">
                              <div className="col-md-12">
                                <StripeProvider
                                  apiKey={config.get(
                                    "configData.stripe_publishable_key"
                                  )}
                                >
                                  <Elements>
                                    <AddCardSec
                                      cardAddedStatusChange={
                                        this.cardAddedStatusChange
                                      }
                                    />
                                  </Elements>
                                </StripeProvider>
                              </div>
                              <div className="col-md-4"></div>
                            </div>
                          </div>
                        ) : null}
                        {showPayPal && total != 0 ? (
                          <PaypalExpressBtn
                            env={env}
                            client={client}
                            currency={currency}
                            total={total}
                            onError={this.paypalOnError}
                            onSuccess={this.paypalOnSuccess}
                            onCancel={this.paypalOnCancel}
                          />
                        ) : null}
                        <div className="text-right">
                          <button
                            className="pay-btn width-120 captalize"
                            type="button"
                            onClick={this.payNow}
                            disabled={paynowButtonDisable}
                          >
                            {paynowButtonLoadingContent != null
                              ? paynowButtonLoadingContent
                              : "Pay Now"}
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="Spacer-8"></div>
        </div>
      );
    }
  }
}

export default withToastManager(SubscriptionInvoiceIndex);
