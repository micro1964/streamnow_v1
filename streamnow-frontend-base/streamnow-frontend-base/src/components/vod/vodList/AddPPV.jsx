import React, { Component } from "react";

class AddPPV extends Component {
  state = {};
  render() {
    const {
      PPVChange,
      PPVLoadingContent,
      PPVButtonDisable,
      PPVInputData,
      setPPV,
    } = this.props;
    return (
      <div class="modal fade view-group" id="add-ppv" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div className="modal-header">
              <button
                class="close"
                data-dismiss="modal"
                id="language_close"
                type="button"
              >
                ×
              </button>
              <h4 class="title">Set PPV</h4>
            </div>
            <div class="modal-body sm-padding">
              <div className="form-group ">
                <div className="row">
                  <div className="col-md-12">
                    <label>Payment type:</label>
                  </div>

                  <div className="col-md-6">
                    <label className="custom-radio-btn">
                      One Time Payment
                      <input
                        type="radio"
                        name="type_of_subscription"
                        value={1}
                        onChange={PPVChange}
                        checked={
                          PPVInputData.type_of_subscription == 1 ? true : false
                        }
                      />
                      <span className="checkmark"></span>
                    </label>
                  </div>
                  <div className="col-md-6">
                    <label className="custom-radio-btn">
                      Recurring Payment
                      <input
                        type="radio"
                        name="type_of_subscription"
                        value={2}
                        onChange={PPVChange}
                        checked={
                          PPVInputData.type_of_subscription == 2 ? true : false
                        }
                      />
                      <span className="checkmark choose-date-check"></span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Amount</label>
                <input
                  class="form-control"
                  placeholder="Enter your full name here"
                  name="amount"
                  value={PPVInputData.amount}
                  onChange={PPVChange}
                  type="number"
                  min="0"
                  step="any"
                />
              </div>

              <div class="form-group">
                <button
                  className="btn btn-group"
                  type="submit"
                  onClick={setPPV}
                  disabled={PPVButtonDisable}
                >
                  {PPVLoadingContent != null ? PPVLoadingContent : "Submit"}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default AddPPV;
