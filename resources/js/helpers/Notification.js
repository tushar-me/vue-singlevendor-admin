class Notification{
    i(desc, title) {
        this.$Notice.info({
            title: title,
            desc: desc
        });
    }
    s(desc, title) {
        this.$Notice.success({
            title: title,
            desc: desc
        });
    }
    w(desc, title) {
        this.$Notice.warning({
            title: title,
            desc: desc
        });
    }
    e(desc, title) {
        this.$Notice.error({
            title: title,
            desc: desc
        });
    }
    ti(msg) {
        this.$Notice.info({
            title: msg,
        });
    }
    ts(msg) {
        this.$Notice.success({
            title: msg,
        });
    }
    tw(msg) {
        this.$Notice.warning({
            title: msg,
        });
    }
    te(msg) {
        this.$Notice.error({
            title: msg,
        });
    }
    swr(desc="Sumthing want worong! Please try again", title="Opps..") {
        this.$Notice.error({
            title: title,
            desc: desc
        });
    }
}

export default Notification = new Notification();
