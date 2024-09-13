let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

function updateTime() {
    const now = new Date();
    const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const timeString = now.toLocaleTimeString('id-ID', options); // Indonesian format

    document.getElementById('currentTime').innerText = timeString;
}

function createCalendar(month, year) {
    const calendarContainer = document.getElementById('calendar');
    const monthYearElement = document.getElementById('calendarMonthYear');
    const days = [];
    const today = new Date();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const currentDay = today.getDate();
    
    // Calculate the days in the current month
    for (let i = 1; i <= lastDay.getDate(); i++) {
        const date = new Date(year, month, i);
        days.push(date);
    }

    // Set month and year display
    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    monthYearElement.innerText = `${monthNames[month]} ${year}`;

    let html = '<table><thead><tr>';
    html += '<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>';
    html += '</tr></thead><tbody><tr>';

    // Fill in empty cells for the days before the start of the month
    for (let i = 0; i < firstDay.getDay(); i++) {
        html += '<td></td>';
    }

    // Generate calendar rows
    days.forEach((date, index) => {
        const day = date.getDate();
        const isToday = (date.getDate() === currentDay && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear()) ? 'class="today"' : '';
        html += `<td ${isToday}>${day}</td>`;

        // Move to next row after Saturday
        if ((index + firstDay.getDay() + 1) % 7 === 0) {
            html += '</tr><tr>';
        }
    });

    html += '</tr></tbody></table>';
    calendarContainer.innerHTML = html;
}

document.getElementById('prevMonth').addEventListener('click', () => {
    if (currentMonth === 0) {
        currentMonth = 11;
        currentYear--;
    } else {
        currentMonth--;
    }
    createCalendar(currentMonth, currentYear);
});

document.getElementById('nextMonth').addEventListener('click', () => {
    if (currentMonth === 11) {
        currentMonth = 0;
        currentYear++;
    } else {
        currentMonth++;
    }
    createCalendar(currentMonth, currentYear);
});

// Initial calendar creation
createCalendar(currentMonth, currentYear);

// JavaScript to update the current time
setInterval(updateTime, 1000);
updateTime(); // Initial call to display time immediately
