import { Component, OnInit} from '@angular/core';
import { FormsModule } from "@angular/forms";
import { NgxBootstrapSliderModule } from "ngx-bootstrap-slider";
import {TranslateService} from '@ngx-translate/core';;
import $ from 'jquery'; 
declare var $: any;



@Component({
  selector: "pention-calculator",
  templateUrl: "./app.component.html",
  styleUrls: ["./app.component.css"]
})


export class AppComponent implements OnInit {


  pension = {
    currentAge: 30,
    retirementAge: 60,
    currentSalary: 50000,
    // initialInvestment: 10000.0,
    // monthlyPayment: 100.0,
    inflation: 0.01,
    includeStatePension: true,
    currentPensionValue: 50000,
    personalOneOffContribution: 0,
    personalMonthlyContribution: 50,
    employerMonthlyContribution: 50,
    extraInMonthlyPaymentsToReachIdealValue: 250,
    currentAgePerc: 0,
    retirementAgePerc: 0,
    currentSalaryPerc: 0,
    personalOneOffContributionPerc: 0,
    personalMonthlyContributionPerc: 0,
    employerMonthlyContributionPerc: 0,
    currentPensionValuePerc: 0,
    totalPot: 0,
    totalPotStr: 0,
    saving: 0,
    monthlyPaymentcotributing: 0,
    savingfinel: 0,
    pottoreachideal: 0,
    finalamontfeature: 0,
    pot: 0,
    annualIncome: 0,
    annualIncomeStr: 0,
    idealAnnualIncome: 0,
    idealTotalPot: 0,
    idealTotalPotStr: 0,
    annualIncomeFromIdealPot: 0,
    featurevalue: 0,
    idealPension: 0,
    extraInMonthlyPaymentsToReachIdealValueStr: 0,
    annualIncomeFromIdealPotStr: 0
  };

  // All rate 

  RATE_OF_INCREASE_OF_INITIAL_INVESTMENT = 0.04;
  NUMBER_OF_TIMES_INTEREST_IS_COMPOUNDED_PER_YEAR = 1;
  RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS = Math.pow(1 + 0.0401 / 1, 1 / 12) - 1;
  STATE_PENSION = 8546.2;
  ANNUAL_PERCENTAGE_SALARY_INCREASE = 0.03;
  LIFE_EXPECTANCY = 83;
  RATE_OF_RETURN_ON_FINAL_POT = 0.03;
  ANTICIPATED_WITHDRAWAL = 1;
  NUMBER_OF_TIMES_SALARY_INTEREST_IS_COMPOUNDED_PER_YEAR = 1;
  annualReturn = 0.0015;

  inflation_percent = 2; //  c16 2%
  inflation = 0.02; //. Inflation for employee contributions. 2% C16

  numberOfYearsInvestedFor = 0;
  yearsInDrawdown = 0;
  growth = 5;
  fees = 0.99; // 0.99. after deduction ; c36
  fees_on_final_pot = 0.85; //0.85%
  salary_increase_pre_inflation = 3; // 3% C35
  nocompoundedperyear = 1;

  initialInvestment;
  // eslint-disable-next-line no-unused-vars
  monthlyPayment;
  monthlyPaymentPers;
  monthlyPaymentEmp;
  initial;
  monthlyPer;
  monthlyEmp;
  monthly;
  statePension;
  annualIncome;
  salaryAtRetirement;
  idealAnnualIncome;
  idealTotalPot;
  annualIncomeFromIdealPot;
  totalPotDifference;
  future_value;
  Initialideal;
  amount;

  //my-slider-properties:
  mySliderValue = 0;

  sliders = {
    currentAge: {
      min: 18, // 18,
      max: 90
    },
    retirementAge: {
      min: 40, // 40,
      max: 80
    },
    currentSalary: {
      min: 0, // 15000,
      max: 150000,
      step: 1000
    },
    personalOneOffContribution: {
      min: 0, // 100,
      max: 300000,
      step: 1000
    },
    personalMonthlyContribution: {
      min: 0,
      max: 2000,
      step: 50
    },
    employerMonthlyContribution: {
      min: 0,
      max: 2000,
      step: 50
    },
    currentPensionValue: {
      min: 0,
      max: 800000,
      step: 1
    }
  };

 




  constructor(private translate: TranslateService) {
    translate.setDefaultLang('en');
 }
 

  //$idealPension = ($idealIncome-$state_pension_income)*((1+$annualReturn*$withdrawalExpected)*((1-(1+$annualReturn)**-$yearsindrawdown)/$annualReturn));

  getIdealfeaturevaluev3(currentPensionValue) {
    return (
      currentPensionValue *
      Math.pow(
        1 + (this.growth - this.fees) / 100 / this.nocompoundedperyear,
        this.nocompoundedperyear * this.numberOfYearsInvestedFor
      )
    );
  }


  getIdealpotvaluev3(future_value) {
    return (
      (future_value -
        this.statePension *
          Math.pow(1 + this.inflation, this.numberOfYearsInvestedFor)) *
      ((1 + this.annualReturn * 1) *
        ((1 - Math.pow(1 + this.annualReturn, -this.yearsInDrawdown)) /
          this.annualReturn))
    );
  }

  =+(H16-C21*(1+Inflation)^TimeToRetire)*((1+$C$27*$C$28)*((1-(1+$C$27)^-$C$24)/C27))


  getIdealpemnsionvalueFromInitialPayment(Initialideal) {
    return (
      Initialideal *
      (((1 + this.annualReturn * this.ANTICIPATED_WITHDRAWAL) *
        (1 - Math.pow(1 + this.annualReturn, -this.yearsInDrawdown))) /
        this.annualReturn)
    );
  }

  valueFromInitialPayment(initialInvestment) {
    return (
      initialInvestment *
      Math.pow(
        1 +
          this.RATE_OF_INCREASE_OF_INITIAL_INVESTMENT /
            this.NUMBER_OF_TIMES_INTEREST_IS_COMPOUNDED_PER_YEAR,
        this.NUMBER_OF_TIMES_INTEREST_IS_COMPOUNDED_PER_YEAR *
          this.numberOfYearsInvestedFor
      )
    );
  }

  valueFromMonthlyPaymentsPers(monthlyPaymentPers) {
    return (
      ((1.25 *
        monthlyPaymentPers *
        (Math.pow(
          1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS,
          12 * this.numberOfYearsInvestedFor
        ) -
          1)) /
        this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS) *
      (1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS)
    );
  }

  valueFromMonthlyPaymentsEmp(monthlyPaymentEmp) {
    return (
      ((monthlyPaymentEmp *
        (Math.pow(
          1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS,
          12 * this.numberOfYearsInvestedFor
        ) -
          1)) /
        this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS) *
      (1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS)
    );
  }

  calcPerc(value, min, max) {
    return (
      ((100 / (parseInt(max, 10) - parseInt(min, 10))) * parseInt(value, 10) -
        (100 / (parseInt(max, 10) - parseInt(min, 10))) * parseInt(min, 10)) /
      100.0
    );
  }

  updatePersonalOneOffContribution(value) {
    // console.log("value: %o", value);
    this.pension.personalOneOffContribution = value;
  }

  calcAnnualIncome(totalPot) {
    return (
      totalPot /
      ((1 + this.RATE_OF_RETURN_ON_FINAL_POT * this.ANTICIPATED_WITHDRAWAL) *
        ((1 -
          Math.pow(
            1 + this.RATE_OF_RETURN_ON_FINAL_POT,
            -1 * this.yearsInDrawdown
          )) /
          this.RATE_OF_RETURN_ON_FINAL_POT))
    );
  }

  calcTotalPot(idealAnnualIncome) {
    return (
      idealAnnualIncome *
      ((1 + this.RATE_OF_RETURN_ON_FINAL_POT * this.ANTICIPATED_WITHDRAWAL) *
        ((1 -
          Math.pow(
            1 + this.RATE_OF_RETURN_ON_FINAL_POT,
            -1 * this.yearsInDrawdown
          )) /
          this.RATE_OF_RETURN_ON_FINAL_POT))
    );
  }

  calcExtraInMonthlyPaymentsToReachIdealValue(totalPotDifference) {
    return (
      (this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS * this.totalPotDifference) /
      (1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS) /
      1.25 /
      (Math.pow(
        1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS,
        12 * this.numberOfYearsInvestedFor
      ) -
        1)
    );
  }

  getIdealsavingv3(pottoreachideal) {
    return (
      (this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS * pottoreachideal) /
      (1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS) /
      1.25 /
      (Math.pow(
        1 + this.RATE_OF_INCREASE_OF_MONTHLY_PAYMENTS,
        12 * this.numberOfYearsInvestedFor
      ) -
        1)
    );
  }

  updateVariables() {
    //console.log("includeStatePension: %o", this.pension.includeStatePension);
    this.pension.currentAgePerc = this.calcPerc(
      this.pension.currentAge,
      this.sliders.currentAge.min,
      this.sliders.currentAge.max
    );
    this.pension.retirementAgePerc = this.calcPerc(
      this.pension.retirementAge,
      this.sliders.retirementAge.min,
      this.sliders.retirementAge.max
    );
    this.pension.currentSalaryPerc = this.calcPerc(
      this.pension.currentSalary,
      this.sliders.currentSalary.min,
      this.sliders.currentSalary.max
    );
    this.pension.personalOneOffContributionPerc = this.calcPerc(
      this.pension.personalOneOffContribution,
      this.sliders.personalOneOffContribution.min,
      this.sliders.personalOneOffContribution.max
    );
    this.pension.personalMonthlyContributionPerc = this.calcPerc(
      this.pension.personalMonthlyContribution,
      this.sliders.personalMonthlyContribution.min,
      this.sliders.personalMonthlyContribution.max
    );
    this.pension.employerMonthlyContributionPerc = this.calcPerc(
      this.pension.employerMonthlyContribution,
      this.sliders.employerMonthlyContribution.min,
      this.sliders.employerMonthlyContribution.max
    );
    // this.pension.initialInvestmentPerc = this.calcPerc(this.pension.initialInvestment, this.sliders.initialInvestment.min, this.sliders.initialInvestment.max);
    // this.pension.monthlyPaymentPerc = this.calcPerc(this.pension.monthlyPayment, this.sliders.monthlyPayment.min, this.sliders.monthlyPayment.max);
    this.pension.currentPensionValuePerc = this.calcPerc(
      this.pension.currentPensionValue,
      this.sliders.currentPensionValue.min,
      this.sliders.currentPensionValue.max
    );

    this.numberOfYearsInvestedFor =
      this.pension.retirementAge - this.pension.currentAge;
    this.yearsInDrawdown = this.LIFE_EXPECTANCY - this.pension.retirementAge;

    this.initialInvestment =
      this.pension.currentPensionValue +
      this.pension.personalOneOffContribution;
    // console.log("initialInvestment: %o", initialInvestment);
    this.monthlyPayment =
      this.pension.personalMonthlyContribution +
      this.pension.employerMonthlyContribution;
    // console.log("monthlyPayment: %o", monthlyPayment);

    this.monthlyPaymentPers = this.pension.personalMonthlyContribution;
    this.monthlyPaymentEmp = this.pension.employerMonthlyContribution;

    this.initial = this.valueFromInitialPayment(this.initialInvestment);
    console.log("initial: %o", this.monthlyPaymentPers);
    this.monthlyPer = this.valueFromMonthlyPaymentsPers(
      this.monthlyPaymentPers
    );
    console.log("monthlyPer: %o", this.monthlyPer);
    this.monthlyEmp = this.valueFromMonthlyPaymentsEmp(this.monthlyPaymentEmp);
    // console.log("monthlyEmp: %o", monthlyEmp);
    this.monthly = this.monthlyPer + this.monthlyEmp;
    // console.log("monthly: %o", monthly);

    this.statePension = 0;
    if (this.pension.includeStatePension)
      this.statePension = this.STATE_PENSION;

    this.pension.totalPot = this.initial + this.monthly;
    this.pension.totalPotStr = this.pension.totalPot;

    console.log("statePension: %o", this.pension.totalPotStr);

    this.annualIncome = this.calcAnnualIncome(this.pension.totalPot);
    this.pension.annualIncome = this.annualIncome;
    if (this.pension.includeStatePension) {
      this.pension.annualIncome += this.statePension;
    }
    this.pension.annualIncomeStr = this.pension.annualIncome;

    this.salaryAtRetirement =
      this.pension.currentSalary *
      Math.pow(
        1 +
          this.ANNUAL_PERCENTAGE_SALARY_INCREASE /
            this.NUMBER_OF_TIMES_INTEREST_IS_COMPOUNDED_PER_YEAR,
        this.numberOfYearsInvestedFor
      );

    this.idealAnnualIncome = 0.6 * this.salaryAtRetirement;
    this.pension.idealAnnualIncome = this.idealAnnualIncome;
    if (this.pension.includeStatePension) {
      this.pension.idealAnnualIncome -= this.statePension;
    }
    console.log("this.idealAnnualIncome: %o", this.idealAnnualIncome);
    this.idealTotalPot = this.calcTotalPot(this.pension.idealAnnualIncome);
    this.pension.idealTotalPot = this.idealTotalPot;
    console.log("this.idealTotalPot: %o", this.idealTotalPot);
    this.pension.idealTotalPotStr = this.pension.idealTotalPot;

    this.annualIncomeFromIdealPot = this.calcAnnualIncome(this.idealTotalPot);
    this.pension.annualIncomeFromIdealPot = this.annualIncomeFromIdealPot;
    if (this.pension.includeStatePension) {
      this.pension.annualIncomeFromIdealPot += this.statePension;
    }

    this.pension.annualIncomeFromIdealPotStr = this.pension.annualIncomeFromIdealPot;

    this.totalPotDifference =
      this.pension.idealTotalPot - this.pension.totalPot;
    this.pension.extraInMonthlyPaymentsToReachIdealValue = this.calcExtraInMonthlyPaymentsToReachIdealValue(
      this.totalPotDifference
    );
    this.pension.extraInMonthlyPaymentsToReachIdealValueStr = this.pension.extraInMonthlyPaymentsToReachIdealValue;

    this.Initialideal = this.pension.currentSalary - this.statePension;
    this.future_value =
      this.pension.currentSalary *
      Math.pow(1 + this.inflation, this.numberOfYearsInvestedFor);

   

    this.pension.idealPension = Math.round(
      this.getIdealpemnsionvalueFromInitialPayment(this.Initialideal)
    );
    this.pension.pot = Math.round(this.getIdealpotvaluev3(this.future_value));

  

    this.pension.featurevalue = this.getIdealfeaturevaluev3(
      this.pension.currentPensionValue + this.pension.personalOneOffContribution
    );

    console.log("this.idealTotalPot: %o", this.pension.featurevalue);
    this.pension.finalamontfeature = Math.round(
      this.pension.featurevalue + this.monthlyPer + this.monthlyEmp
    );
    this.pension.pottoreachideal =
      this.getIdealpotvaluev3(this.future_value) -
      (this.pension.featurevalue + this.monthlyPer + this.monthlyEmp);
    console.log(
      this.pension.pottoreachideal +
        "ss" +
        this.getIdealpotvaluev3(this.future_value) +
        "sss" +
        (this.pension.featurevalue + this.monthlyPer + this.monthlyEmp)
    );
    this.pension.saving = Math.round(
      this.getIdealsavingv3(this.pension.pottoreachideal)
    );
    this.pension.monthlyPaymentcotributing = this.monthlyPayment;
    this.pension.savingfinel =
      this.pension.monthlyPaymentcotributing + this.pension.saving;
  }

  ngOnInit() {
    this.updateVariables();
    

    $('.current-age input').change(function(){
      var cu =$('.current-age  input') .val();
      var re = $('.retirement-age input') .val();  
      if(cu>re){
      alert("current age cant be bigger ")
      $('.retirement-age input').val($(this).val());
      $('.retirement-age input').css('background-size', $(event.target).css('background-size'));
      }
      });

      $('.retirement-age input').change(function(){
        var cu =$('.current-age  input') .val();
        var re = $('.retirement-age input') .val();  
        if(cu>re){
        alert("current age cant be bigger ")
        $('.retirement-age input').val($('.current-age input').val());
        $(event.target).css('background-size', $('.current-age  input').css('background-size'));

        }
        
        
        });

    
  }

 




  styleRender() {
    return this.pension.personalOneOffContribution / 1000 / 2 + "%";
  }

  function1(element) {
    console.log(element.checked ? "it's checked" : "it's not checked");
  }



 

  /**
   * Slider Change event
   * @param event
   *
   * current value contain the upto date value.
   * Some reason original model is not working. instead use change event.
   */
  mySliderChange(event) {
    let currentValue = event.newValue;
    console.log(currentValue);
  }





}
