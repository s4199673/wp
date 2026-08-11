function calculateDiscount(originalPrice, discountPercent) {
    const discountAmount = originalPrice * (discountPercent / 100);
    return originalPrice - discountAmount;
}

document.getElementById("calculateDiscount").addEventListener("click", function () {
        const originalPrice = parseFloat(document.getElementById("originalPrice").value);
        const discountPercent = parseFloat(document.getElementById("discountPercent").value);
        const result = document.getElementById("discountResult");
        if (isNaN(originalPrice) || isNaN(discountPercent)) {
            result.innerHTML = "Please enter valid numbers.";
            return;
        }
        if (originalPrice < 0 || discountPercent < 0 || discountPercent > 100) {
            result.innerHTML = "Please enter a valid price and a discount between 0 and 100.";
            return;
        }
        const finalPrice = calculateDiscount(originalPrice, discountPercent);
        result.innerHTML = "Final price: $" + finalPrice.toFixed(2);
    });