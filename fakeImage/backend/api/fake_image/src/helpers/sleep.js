
exports.sleep = (seconds) => {
    const milliseconds = seconds * 1000;
    const start = new Date().getTime();
    let current = start;

    while (current - start < milliseconds) {
        current = new Date().getTime();
    }
}
