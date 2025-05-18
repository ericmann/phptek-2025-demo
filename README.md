# PHP Concurrency Demo: Sequential vs. Concurrent Requests

This demo illustrates the performance difference between fetching multiple web pages sequentially versus concurrently using PHP's `amp/http-client`.

## Purpose

The goal is to showcase how asynchronous programming can significantly reduce the total time required to perform multiple I/O-bound operations, such as fetching data from several websites. This is particularly relevant in web applications where responsiveness and speed are critical.

## Files

*   `sequential.php`: Fetches the content of multiple websites one after the other. It uses `file_get_contents()` to retrieve the content and measures the time taken for each request and the total time.

*   `concurrent.php`: Fetches the content of the same websites concurrently using `amp/http-client`. It creates an array of Futures, each representing an asynchronous request. The script then awaits all requests to complete, measuring the time taken for each and the total time.

*   `fibers.php`: Demonstrates PHP Fibers, a low-level concurrency primitive introduced in PHP 8.1. The script shows how a Fiber can be started, suspended, and resumed, allowing manual control over execution flow. This is useful for understanding the building blocks of async frameworks like Amp.

## Setup

1.  **Install PHP:** Ensure you have PHP 8.3 or higher installed.
2.  **Install Dependencies:** Navigate to the project directory in your terminal and run:

    ```bash
    composer install
    ```

    This will install the required `amphp/http-client` library.

## Usage

1.  **Run Sequential Script:**

    ```bash
    php sequential.php
    ```

    This will output the time taken to fetch each website's content sequentially, along with the total time.

2.  **Run Concurrent Script:**

    ```bash
    php concurrent.php
    ```

    This will output the time taken to fetch each website's content concurrently, along with the total time.

3.  **Run Fiber Demo Script:**

    ```bash
    php fibers.php
    ```

    This will demonstrate the usage of PHP Fibers, showing how they can be started, suspended, and resumed.

## Expected Results

You should observe that the `concurrent.php` script completes significantly faster than the `sequential.php` script. This is because the concurrent script can fetch multiple web pages simultaneously, while the sequential script must wait for each request to complete before starting the next.

## Notes

*   Some websites may block requests from scripts like `file_get_contents()` or `amp/http-client` if proper headers (like `User-Agent`) are not set or if they detect bot-like behavior.
*   The performance gain from concurrency will be more noticeable with a larger number of URLs and websites with higher latency.
