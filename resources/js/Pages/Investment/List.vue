<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
    <div
      class="px-4 py-5 border-b border-gray-200 sm:px-6 inline-flex justify-between w-full items-center select-none cursor-pointer"
      @click="isVisible = !isVisible"
    >
      <div>
        <h3 class="text-xl leading-6 font-medium text-gray-900">{{ investment.investmentName }}</h3>
        <p
          class="mt-1 max-w-2xl text-sm leading-5 text-gray-500"
        >Started {{ investment.investedAtRedable }}</p>
      </div>

      <button class="outline-none focus:outline-none">
        <svg
          class="w-7 h-7 text-gray-500 hover:text-gray-400 transform duration-700"
          :class="{ 'rotate-180' : isVisible}"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path v-if="!isVisible" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          <path v-if="isVisible" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
    </div>
    <div v-if="isVisible">
      <dl>
        <div
          class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
          v-if="investment.isRecurring"
        >
          <dt class="text-sm leading-5 font-medium text-gray-500">Monthly Installment</dt>
          <dd
            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
          >{{ monthlyInstallment }}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6" v-else>
          <dt class="text-sm leading-5 font-medium text-gray-500">Invested</dt>
          <dd
            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
          >{{ withoutInterestInvestmentValue }}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">Interest Earned</dt>
          <dd
            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
          >{{ totalInterestEarned }}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">Current Investment Value</dt>
          <dd
            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
          >{{ currentInvestmentValue }}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">Started on</dt>
          <dd
            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
          >{{ investment.investedAt }}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">Percentage Increase</dt>
          <dd
            class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"
          >{{ investment.percentageIncreased }} %</dd>
        </div>
      </dl>
    </div>
  </div>
</template>

<script>
import { toIndiaFormat } from "./../../Composition/Util";

export default {
  props: ["investment"],

  data() {
    return {
      isVisible: false,
    };
  },

  methods: {
    toIndiaFormat,
  },

  computed: {
    withoutInterestInvestmentValue() {
      return `₹ ${this.toIndiaFormat(
        this.investment.withoutInterestInvestmentValue
      )}`;
    },
    totalInterestEarned() {
      return `₹ ${this.toIndiaFormat(this.investment.totalInterestEarned)}`;
    },
    currentInvestmentValue() {
      return `₹ ${this.toIndiaFormat(this.investment.currentInvestmentValue)}`;
    },
    monthlyInstallment() {
      return `₹ ${this.toIndiaFormat(this.investment.amount)}`;
    },
  },
};
</script>
