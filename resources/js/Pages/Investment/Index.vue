<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Investments</h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4 mt-4 bg-white w-full h-32 rounded-md shadow-md p-3 mb-6">
          <div class="w-1/3 flex flex-col items-center lg:border-r">
            <strong class="font-medium text-gray-600">
              <span class="mr-1 text-3xl">₹</span>
              <span class="text-5xl">{{ toIndiaFormat(withoutInterestInvestmentValue) }}</span>
            </strong>
            <p
              class="text-sm font-medium text-gray-500 uppercase tracking-wide"
            >Total Investments Value</p>
          </div>

          <div class="w-1/3 flex flex-col items-center lg:border-r">
            <strong class="font-medium text-gray-600 space-x-1">
              <span class="text-3xl text-green-500">+</span>
              <span class="text-3xl">₹</span>
              <span class="text-5xl">{{ toIndiaFormat(interestEarnedUntilNow) }}</span>
            </strong>
            <p
              class="text-sm font-medium text-gray-500 uppe rcase trackin g-wide uppercase"
            >Total Interest Earned</p>
          </div>

          <div class="w-1/3 flex flex-col items-center">
            <strong class="font-medium text-gray-600 space-x-1">
              <span class="text-3xl">₹</span>
              <span class="text-5xl">{{ toIndiaFormat(currentInvestmentValue) }}</span>
              <span class="text-base text-green-500 inline-flex items-end justify-center">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                  />
                </svg>
                ({{ percentageIncreased }}%)
              </span>
            </strong>
            <p
              class="text-sm font-medium text-gray-500 uppe rcase trackin g-wide uppercase"
            >Current Investment Value</p>
          </div>
        </div>

        <List :investment="investment" v-for="(investment, index) in investments" :key="index" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import { toIndiaFormat } from "./../../Composition/Util"
import List from "./List";

export default {
  props: [
    "withoutInterestInvestmentValue",
    "interestEarnedUntilNow",
    "currentInvestmentValue",
    "investments",
    "percentageIncreased",
  ],

  components: {
    AppLayout,
    List,
  },

  methods: {
    toIndiaFormat
  },
};
</script>
