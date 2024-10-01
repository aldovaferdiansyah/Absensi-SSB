let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let schedules = [];

function updateTime() {
    const now = new Date();
    const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const timeString = now.toLocaleTimeString('id-ID', options);
    document.getElementById('currentTime').innerText = timeString;
}

let formatTime = (time) => {
    return time.substring(0, 5); // Ambil 4 angka pertama dari waktu (HH:MM)
};

function createCalendar(month, year, schedules) {
    const calendarContainer = document.getElementById('calendar');
    const monthYearElement = document.getElementById('calendarMonthYear');
    const today = new Date();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const currentDay = today.getDate();

    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    monthYearElement.innerText = `${monthNames[month]} ${year}`;

    let html = '<table><thead><tr>';
    html += '<th>Minggu</th><th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th>';
    html += '</tr></thead><tbody><tr>';

    for (let i = 0; i < firstDay.getDay(); i++) {
        html += '<td></td>';
    }

    for (let i = 1; i <= lastDay.getDate(); i++) {
        const date = new Date(year, month, i);
        const isToday = (date.getDate() === currentDay && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear()) ? 'class="today"' : '';

        let eventHTML = '';
        schedules.forEach(event => {
            const eventDate = new Date(event.date);
            if (eventDate.getDate() === date.getDate() && eventDate.getMonth() === date.getMonth() && eventDate.getFullYear() === date.getFullYear()) {
                eventHTML += `<div class="event">
                                <strong>${event.title}</strong><br>
                                ${event.description ? event.description : ' '} <br>
                                <strong>${formatTime(event.time_start)} - ${formatTime(event.time_end)}</strong>
                              </div>`;
            }
        });

        html += `<td ${isToday}>${i}${eventHTML}</td>`;

        if ((i + firstDay.getDay()) % 7 === 0) {
            html += '</tr><tr>';
        }
    }

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
    createCalendar(currentMonth, currentYear, schedules);
});

document.getElementById('nextMonth').addEventListener('click', () => {
    if (currentMonth === 11) {
        currentMonth = 0;
        currentYear++;
    } else {
        currentMonth++;
    }
    createCalendar(currentMonth, currentYear, schedules);
});

createCalendar(currentMonth, currentYear, schedules);

setInterval(updateTime, 1000);
updateTime();
