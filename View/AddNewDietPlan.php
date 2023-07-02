<?php

include_once("./Model/CowModal.php");
require_once("./Model/DietModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, "cows");
?>

<div class="MainPage">
    <form class="InputForms" id="AddNewDietPlan">
        <h1>Add Diet Plan</h1>

        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Diet Plane Name</label>
            <input type="text" class="form-control" id="text" name="email" aria-describedby="breedHelp" required />
        </div>

        <div class="mb-3 form-input">
            <label for="quantity" class="form-label">Description</label>
            <input type="number" class="form-control" min="0" id="text" name="password" aria-describedby="breedHelp"
                required />
        </div>

        <!-- DropDown CheckBox -->
        <div class="dropdown">
            <button class="dropdown-button">Select Options</button>
            <div class="dropdown-content">
                <label><input type="checkbox" name="option1">Option 1</label><br>
                <label><input type="checkbox" name="option2">Option 2</label><br>
                <label><input type="checkbox" name="option3">Option 3</label><br>
            </div>
        </div>

        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn submit"><span><svg style="fill: white;" xmlns="http://www.w3.org/2000/svg"
                        width="20" height="16">
                        <path
                            d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                        </path>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                        </path>
                    </svg></span>Add the entry</button>

            <a href="./DietPlans" class="btn btn-danger submit">Cancel</a>
        </div>
    </form>
</div>
</div>
<script>
    (function ($) {
        var CheckboxDropdown = function (el) {
            var _this = this;
            this.isOpen = false;
            this.areAllChecked = false;
            this.$el = $(el);
            this.$label = this.$el.find('.dropdown-label');
            this.$checkAll = this.$el.find('[data-toggle="check-all"]').first();
            this.$inputs = this.$el.find('[type="checkbox"]');

            this.onCheckBox();

            this.$label.on('click', function (e) {
                e.preventDefault();
                _this.toggleOpen();
            });

            this.$checkAll.on('click', function (e) {
                e.preventDefault();
                _this.onCheckAll();
            });

            this.$inputs.on('change', function (e) {
                _this.onCheckBox();
            });
        };

        CheckboxDropdown.prototype.onCheckBox = function () {
            this.updateStatus();
        };

        CheckboxDropdown.prototype.updateStatus = function () {
            var checked = this.$el.find(':checked');

            this.areAllChecked = false;
            this.$checkAll.html('Check All');

            if (checked.length <= 0) {
                this.$label.html('Select Options');
            }
            else if (checked.length === 1) {
                this.$label.html(checked.parent('label').text());
            }
            else if (checked.length === this.$inputs.length) {
                this.$label.html('All Selected');
                this.areAllChecked = true;
                this.$checkAll.html('Uncheck All');
            }
            else {
                this.$label.html(checked.length + ' Selected');
            }
        };

        CheckboxDropdown.prototype.onCheckAll = function (checkAll) {
            if (!this.areAllChecked || checkAll) {
                this.areAllChecked = true;
                this.$checkAll.html('Uncheck All');
                this.$inputs.prop('checked', true);
            }
            else {
                this.areAllChecked = false;
                this.$checkAll.html('Check All');
                this.$inputs.prop('checked', false);
            }

            this.updateStatus();
        };

        CheckboxDropdown.prototype.toggleOpen = function (forceOpen) {
            var _this = this;

            if (!this.isOpen || forceOpen) {
                this.isOpen = true;
                this.$el.addClass('on');
                $(document).on('click', function (e) {
                    if (!$(e.target).closest('[data-control]').length) {
                        _this.toggleOpen();
                    }
                });
            }
            else {
                this.isOpen = false;
                this.$el.removeClass('on');
                $(document).off('click');
            }
        };

        var checkboxesDropdowns = document.querySelectorAll('[data-control="checkbox-dropdown"]');
        for (var i = 0, length = checkboxesDropdowns.length; i < length; i++) {
            new CheckboxDropdown(checkboxesDropdowns[i]);
        }
    })(jQuery);
</script>