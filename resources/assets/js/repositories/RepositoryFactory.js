import EventsRepository from './eventsRepository';

const repositories = {
    events: EventsRepository,
};

export const RepositoryFactory = {
    get: name => repositories[name]
};